<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Sekolah;
use App\Models\Tapel;
use App\Models\Tingkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KelasController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $user = Auth::user();
    if (Auth::user()->sekolah_id == 0) {
      if ($user->isAdmin()) {
        $data = Kelas::orderBy('tingkat_id', 'asc')->orderBy('name', 'asc');
      } elseif($user->isWaliKelas()){
        $data = Kelas::where('guru_id', $user->guru->id);
      } else {
        abort(403);
      }
      $guru = Guru::select('id','name')->orderBy('name', 'asc')->get();
    }else{
      if ($user->isAdmin()) {
        $data = Kelas::where('sekolah_id',Auth::user()->sekolah_id)->orderBy('tingkat_id', 'asc')->orderBy('name', 'asc');
      } elseif($user->isWaliKelas()){
        $data = Kelas::where('sekolah_id',Auth::user()->sekolah_id)->where('guru_id', $user->guru->id);
      } else {
        abort(403);
      }
      $guru = Guru::where('sekolah_id',Auth::user()->sekolah_id)->select('id','name')->orderBy('name', 'asc')->get();
    }

    // dd(Auth::user()->sekolah_id);
    $sekolah = Sekolah::where('status',1)->get();

    if ($request->ajax()) {

      if ($request->tingkat_id) $data->where('tingkat_id', $request->tingkat_id);

      return DataTables::of($data->with('tingkat:id,angka','siswa:id,kelas_id')->withCount('siswa'))->addIndexColumn()
                                  ->editColumn('tingkat.angka', function($data){
                                    return $data->tingkat->angka;})
                                  ->editColumn('guru.name', function($data){
                                    return $data->wali_kelas();})
                                  ->editColumn('siswa.count', function($data){
                                    return $data->siswa_count;})
                                  ->addColumn('aksi', function($data){
                                      return view('pages.kelas._aksi')->with('data', $data);})
                                  ->make(true);
    }

    return view('pages.kelas.index',[
      'kelas' => $data,
      'sekolah' => $sekolah,
      'guru' => $guru,
      'tapel' => Tapel::get(),
      'tingkat' => Tingkat::get(),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      // return view('pages.kelas.create');
      abort(404);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validasi = Validator::make($request->all(),[
      'name' => 'required|unique:kelas',
      'guru_id' => ['nullable',
                    'exists:gurus,id',
                    function ($attribute, $value, $fail) use ($request) {
                      $isDuplicate = Kelas::where('guru_id', $request->guru_id)->exists();
                      if ($isDuplicate) $fail('Sudah menjadi Wali Kelas, pilih yang lain');
                    },
                  ],
      'tapel_id' => 'required:tapels,id',
      'tingkat_id' => 'required:tingkats,id',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {
      try {
        DB::beginTransaction();
          $data = [
            'sekolah_id' => $request->sekolah_id,
            'name' => $request->name,
            'guru_id' => $request->guru_id,
            'tapel_id' => $request->tapel_id,
            'tingkat_id' => $request->tingkat_id,
          ];
          Kelas::create($data);
        DB::commit();
        return response()->json(['success' => 'Data berhasil ditambahkan']);

      } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['failed' => $e->getMessage()]);
      }
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Kelas $kela)
  {
      abort(404);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Kelas $kelas)
  {
      return response()->json(['dataEdit' => $kelas]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Kelas $kelas)
  {
    $validasi = Validator::make($request->all(),[
      'name' => 'required|unique:kelas,name,' . $kelas->id,
      'guru_id' => ['nullable',
                    'exists:gurus,id',
                    function ($attribute, $value, $fail) use ($request, $kelas) {
                      if ($request->guru_id == $kelas->guru_id) {
                          return; // Pengecualian, tidak perlu melakukan validasi
                      }
                      $isDuplicate = Kelas::where('guru_id', $request->guru_id)->exists();
                      if ($isDuplicate) $fail('Sudah menjadi Wali Kelas, pilih yang lain');
                    },
                  ],
      'tapel_id' => 'required:tapels,id',
      'tingkat_id' => 'required:tingkats,id',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {

      try {
        DB::beginTransaction();
          $data = [
            'name' => $request->name,
            'guru_id' => $request->guru_id,
            'tape_id' => $request->tapel_id,
            'sekolah_id' => $request->sekolah_id,
            'tingkat_id' => $request->tingkat_id,
          ];
          $kelas->update($data);
        DB::commit();
        return response()->json(['success' => 'Data berhasil diperbarui']);

      } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['failed' => $e->getMessage()]);
      }
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Kelas $kelas)
  {
    $success = $kelas->name . ' berhasil dihapus!';
    $kelas->delete();
    return response()->json(['success' => $success]);
  }

}
