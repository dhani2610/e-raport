<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKelompok;
use App\Models\KelompokProjek;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AnggotaKelompokController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    abort(404);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $exists = AnggotaKelompok::where('kelompok_projek_id', $request->kelompok_projek_id)->pluck('siswa_id');
    // $siswa = Siswa::whereHas('user', fn($q) => $q->where('is_aktif', true))->where('kelas_id', KelompokProjek::find($request->kelompok_projek_id)->kelas_id)->whereNotIn('id', $exists);
    if (Auth::user()->sekolah_id == 0) {
      $siswa = Siswa::whereHas('user', fn($q) => $q->where('is_aktif', true))->where('kelas_id', KelompokProjek::find($request->kelompok_projek_id)->kelas_id)->whereDoesntHave('anggotaKelompok')->orderBy('name', 'asc');
    }else{
      $siswa = Siswa::where('sekolah_id',Auth::user()->sekolah_id)->whereHas('user', fn($q) => $q->where('is_aktif', true))->where('kelas_id', KelompokProjek::find($request->kelompok_projek_id)->kelas_id)->whereDoesntHave('anggotaKelompok')->orderBy('name', 'asc');
    }

    if ($request->ajax()) {

      return DataTables::of($siswa->orderBy('name', 'asc'))->addIndexColumn()
        // ->editColumn('nis' , fn($siswa) => $siswa->nis)
        // ->editColumn('name', fn($siswa) => $siswa->name)
        // ->editColumn('jk', fn($siswa) => $siswa->jk)
        ->addColumn('add', function($siswa){
            return view('pages.kelompokprojek.anggotakelompok._add')->with('id', $siswa->id);})
        ->make(true);
    }
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
      'kelompok_projek_id' => 'required|exists:kelompok_projeks,id',
      'siswa_id' => 'required|exists:siswas,id',
    ]);

    if ($validasi->fails()) {
      return response()->json(['failed' => 'Gagal menambahkan!']);
    } elseif(AnggotaKelompok::where('kelompok_projek_id', $request->kelompok_projek_id)->where('siswa_id', $request->siswa_id)->exists()) {
      return response()->json(['failed' => 'Anggota tersebut tersebut sudah ditambahkan!']);
    } else {
      try {
        DB::beginTransaction();
          AnggotaKelompok::create($request->all());
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
  public function show(KelompokProjek $anggotakelompok, Request $request)
  {
    $kelompokprojek = $anggotakelompok;

    $user = Auth::user();
    if ($user->isAdmin() || ($user->isKoordinatorP5() && ($kelompokprojek->guru->id == $user->guru->id))) {
      $anggotakelompok = AnggotaKelompok::where('kelompok_projek_id', $kelompokprojek->id);
    } else {
      abort(403);
    }

    if ($request->ajax()) {

      return DataTables::of($anggotakelompok->with('siswa','kelompokProjek'))->addIndexColumn()
        ->editColumn('nis', fn($anggotakelompok) => $anggotakelompok->siswa->nis)
        ->editColumn('name', fn($anggotakelompok) => $anggotakelompok->siswa->name)
        ->editColumn('jk', fn($anggotakelompok) => $anggotakelompok->siswa->jk)
        ->addColumn('delete', function($anggotakelompok){
            return view('pages.kelompokprojek.anggotakelompok._delete')->with('id', $anggotakelompok->id);})
        ->make(true);
    }

    return view('pages.kelompokprojek.anggotakelompok.index',[
      'anggotakelompok' => $anggotakelompok,
      'kelompokprojek' => $kelompokprojek,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, AnggotaKelompok $anggotakelompok)
  {
    abort(404);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, AnggotaKelompok $anggotakelompok)
  {
    abort(404);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(AnggotaKelompok $anggotakelompok)
  {
    try {
      DB::beginTransaction();
        $success = 'Data berhasil dihapus!';
        $anggotakelompok->delete();
      DB::commit();
      return response()->json(['success' => $success]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['failed' => 'Terjadi kesalahan!']);
    }
  }

}
