<?php

namespace App\Http\Controllers;

use App\Models\Fase;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelompokProjek;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KelompokController extends Controller
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
        $kelompok = KelompokProjek::query();
      } elseif($user->isKoordinatorP5()){
        $kelompok = KelompokProjek::where('guru_id', $user->guru->id);
      } else {
        abort(403);
      }
      $kelas = Kelas::get();
      $guru = Guru::orderBy('name', 'asc')->get();
    }else{
      if ($user->isAdmin()) {
        $kelompok = KelompokProjek::where('sekolah_id',Auth::user()->sekolah_id)->query();
      } elseif($user->isKoordinatorP5()){
        $kelompok = KelompokProjek::where('sekolah_id',Auth::user()->sekolah_id)->where('guru_id', $user->guru->id);
      } else {
        abort(403);
      }
      $kelas = Kelas::where('sekolah_id',Auth::user()->sekolah_id)->get();
      $guru = Guru::where('sekolah_id',Auth::user()->sekolah_id)->orderBy('name', 'asc')->get();

    }

    $sekolah = Sekolah::where('status',1)->get();


    if ($request->ajax()) {

      if ($request->kelas_id) $kelompok->where('kelas_id', $request->kelas_id);
      if ($request->guru_id) $kelompok->where('guru_id', $request->guru_id);

      return DataTables::of($kelompok->with('guru:id,name', 'kelas:id,name'))->addIndexColumn()
        ->editColumn('kelas.name', fn($kelompok) => $kelompok->kelas->name)
        ->editColumn('guru.name', fn($kelompok) => $kelompok->guru->name)
        ->addColumn('aksi', function($kelompok){
            return view('pages.kelompokprojek.main._aksi')->with('kelompok', $kelompok);})
        ->make(true);
    }

    return view('pages.kelompokprojek.main.index',[
      'sekolah' => $sekolah,
      'kelompok' => $kelompok,
      'kelas' => $kelas,
      'guru' => $guru,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
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
      'kelas_id' => 'required|exists:kelas,id',
      'guru_id' => 'required|exists:gurus,id',
      'name' => 'required',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {
      try {
        DB::beginTransaction();
          KelompokProjek::create($request->all());
        DB::commit();
        return response()->json(['success' => 'Data berhasil ditambahkan']);

      } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['failed' => 'Terjadi kesalahan!']);
      }
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(KelompokProjek $kelompok)
  {
    abort(404);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, KelompokProjek $kelompok)
  {
    if ($request->ajax()) {
      return response()->json(['dataEdit' => $kelompok]);
    } else {
      abort(404);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, KelompokProjek $kelompok)
  {
    $validasi = Validator::make($request->all(),[
      'kelas_id' => 'required|exists:kelas,id',
      'guru_id' => 'required|exists:gurus,id',
      'name' => 'required',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {

      try {
        DB::beginTransaction();
          $kelompok->update($request->all());
        DB::commit();
        return response()->json(['success' => 'Data berhasil diperbarui']);

      } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['failed' => 'Terjadi kesalahan!']);
      }
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(KelompokProjek $kelompok)
  {
    try {
      DB::beginTransaction();
        $success = $kelompok->name . ' berhasil dihapus!';
        $kelompok->delete();
      DB::commit();
      return response()->json(['success' => $success]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['failed' => 'Terjadi kesalahan!']);
    }
  }

}
