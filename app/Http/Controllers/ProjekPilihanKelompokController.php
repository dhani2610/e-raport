<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKelompok;
use App\Models\CapaianAkhir;
use App\Models\CapaianProjek;
use App\Models\CatatanProjek;
use App\Models\KelompokProjek;
use App\Models\NilaiProjek;
use App\Models\Projek;
use App\Models\ProjekPilihanKelompok;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProjekPilihanKelompokController extends Controller
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
    if (Auth::user()->sekolah_id == 0) {
      $exists = ProjekPilihanKelompok::where('kelompok_projek_id', $request->kelompok_projek_id)->pluck('projek_id');
    }else{
      $exists = ProjekPilihanKelompok::where('sekolah_id',Auth::user()->sekolah_id)->where('kelompok_projek_id', $request->kelompok_projek_id)->pluck('projek_id');
    }
    
    $projek = Projek::where('fase_id', KelompokProjek::find($request->kelompok_projek_id)->kelas->tingkat->fase_id)->whereNotIn('id', $exists);

    if ($request->ajax()) {

      return DataTables::of($projek->orderBy('name', 'asc'))->addIndexColumn()
        ->editColumn('fase.name', fn($projek) => $projek->fase->name)
        ->editColumn('deskripsi', fn($projek) => $projek->deskripsi)
        ->addColumn('add', function($projek){
            return view('pages.kelompokprojek.projekpilihankelompok._add')->with('id', $projek->id);})
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
      'projek_id' => 'required|exists:projeks,id',
    ]);

    if ($validasi->fails()) {
      return response()->json(['failed' => 'Gagal menambahkan!']);
    } elseif(ProjekPilihanKelompok::where('kelompok_projek_id', $request->kelompok_projek_id)->where('projek_id', $request->projek_id)->exists()) {
      return response()->json(['failed' => 'Anggota tersebut tersebut sudah ditambahkan!']);
    } else {
      try {
        DB::beginTransaction();
          ProjekPilihanKelompok::create($request->all());
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
  public function show(KelompokProjek $projekpilihankelompok, Request $request)
  {

    $kelompokprojek = $projekpilihankelompok;

    $user = Auth::user();
    if ($user->isAdmin()) {
      $projekpilihankelompok = ProjekPilihanKelompok::where('kelompok_projek_id', $kelompokprojek->id);
    } elseif($user->isKoordinatorP5() && ($kelompokprojek->guru_id == $user->guru->id)){
      $projekpilihankelompok = ProjekPilihanKelompok::where('kelompok_projek_id', $kelompokprojek->id);
    } else {
      abort(403);
    }


    if ($request->ajax()) {

      return DataTables::of($projekpilihankelompok->with('projek','kelompokProjek'))->addIndexColumn()
      ->editColumn('fase.name', fn($q) => $q->projek->fase->name)
      ->editColumn('tema', fn($q) => $q->projek->tema)
      ->editColumn('name', fn($q) => $q->projek->name)
      ->editColumn('deskripsi', fn($q) => Str::limit($q->projek->deskripsi, 40))
        ->addColumn('delete', function($projekpilihankelompok){
            return view('pages.kelompokprojek.projekpilihankelompok._delete')->with(['id' => $projekpilihankelompok->id, 'projekId' => $projekpilihankelompok->projek_id]);})
        ->make(true);
    }

    return view('pages.kelompokprojek.projekpilihankelompok.index',[
      'projekpilihankelompok' => $projekpilihankelompok,
      'kelompokprojek' => $kelompokprojek,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, Projek $projekpilihankelompok)
  {
    $projek = $projekpilihankelompok;
    $projek->load('fase:id,name', 'capaianProjek', 'projekPilihanKelompok');
    return response()->json(['result' => $projek]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, ProjekPilihanKelompok $projekpilihankelompok)
  {
    abort(404);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(ProjekPilihanKelompok $projekpilihankelompok)
  {
    try {
      DB::beginTransaction();
        $success = 'Data berhasil dihapus!';
        $projekpilihankelompok->delete();
      DB::commit();
      return response()->json(['success' => $success]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['failed' => 'Terjadi kesalahan!']);
    }
  }

  public function showNilai(ProjekPilihanKelompok $projekpilihankelompok, Request $request)
  {
    $user = Auth::user();
    if (!$user->isKoordinatorP5() || ($projekpilihankelompok->kelompokprojek->guru->id != $user->guru->id)) {
      abort(403);
    }

    $capaianprojek = CapaianProjek::where('projek_id', $projekpilihankelompok->projek_id)->get();
    $siswaDiKelompokIni = AnggotaKelompok::where('kelompok_projek_id', $projekpilihankelompok->kelompok_projek_id)->pluck('siswa_id');
    $siswa = Siswa::whereIn('id', $siswaDiKelompokIni)->orderBy('name', 'asc');
    $nilai = NilaiProjek::where('capaian_projek_id', $request->capaian_projek_id)->get();

    if ($request->ajax()) {

      return DataTables::of($siswa->with('nilaiProjek'))->addIndexColumn()
        ->editColumn('predikat', function ($q) use ($nilai){
          $predikatSiswa = $nilai->firstWhere('siswa_id', $q->id)['predikat'] ?? null;
          return view('pages.kelompokprojek.inputnilai._predikat')->with([
            'id' => $q->id,
            'predikat' => $predikatSiswa,
          ]);})
        ->make(true);
    }

    // persentase pengisian data
    $totalData = $siswa->count() * $capaianprojek->count();
    $dataSudahDiisi = NilaiProjek::whereIn('capaian_projek_id', $projekpilihankelompok->projek->capaianProjek->pluck('id'))->whereIn('siswa_id', $siswaDiKelompokIni)->get()->count();
    $persentaseDataDiisi = round(($dataSudahDiisi /  $totalData) * 100);

    return view('pages.kelompokprojek.inputnilai.index',[
      'siswa' => $siswa,
      'projekpilihankelompok' => $projekpilihankelompok,
      'capaianakhir' => $capaianprojek,
      'persentase' => $persentaseDataDiisi
    ]);
  }

  public function updateNilai(Request $request, CapaianProjek $capaianprojek){
    $validasi = Validator::make($request->all(),[
      'siswa_id.*' => 'required|exists:siswas,id',
      'predikat.*' => 'nullable',
    ]);

    if ($validasi->fails()) {
      return response()->json(['failed' => 'Gagal menyimpan data. Coba lagi!']);
    }

    try {
      DB::beginTransaction();
        NilaiProjek::where('capaian_projek_id', $capaianprojek->id)->whereIn('siswa_id', $request->siswa_id)->delete();
        foreach($request->siswa_id as $i => $siswaId){
          if (!NilaiProjek::where('siswa_id', $siswaId)->where('capaian_projek_id', $capaianprojek->id)->exists()) {
            if (filled($request->predikat[$i])) {

              $siswa = Siswa::find($siswaId);
              $keterangan = 'Dalam mengerjakan projek ini, ' . $siswa->name;

              // PUSH PREDIKAT KE KETERANGAN
              if ($request->predikat[$i] == 'MB') {
                $keterangan .= ' masih perlu bimbingan dalam hal ' . $capaianprojek->capaianAkhir->name . '. ';
              } elseif ($request->predikat[$i] == 'SDGB') {
                $keterangan .= ' sudah mampu ' . $capaianprojek->capaianAkhir->name . '. ';
              } elseif ($request->predikat[$i] == 'BSH') {
                $keterangan .= ' memiliki kemampuan yang baik dalam hal ' . $capaianprojek->capaianAkhir->name . '. ';
              } else {
                $keterangan .= ' memiliki kemampuan yang sangat baik dalam hal ' . $capaianprojek->capaianAkhir->name . '. ';
              }

              // LOOP KETERANGAN NILAI CAPAIAN LAIN (JIKA ADA)
              $nilaiSiswaDiProjekIni = NilaiProjek::where('siswa_id', $siswaId)->whereHas('capaianProjek', fn($q) => $q->where('projek_id', $capaianprojek->projek_id))->get();
              if ($nilaiSiswaDiProjekIni->count() >= 1) {
                foreach($nilaiSiswaDiProjekIni as $a => $nilaiProjek){
                  if ($nilaiProjek->predikat == 'MB') {
                    $keterangan .= ' masih perlu bimbingan dalam hal ' . $nilaiProjek->capaianProjek->capaianAkhir->name . '. ';
                  } elseif ($nilaiProjek->predikat == 'SDGB') {
                    $keterangan .= ' sudah mampu ' . $nilaiProjek->capaianProjek->capaianAkhir->name . '. ';
                  } elseif ($nilaiProjek->predikat == 'BSH') {
                    $keterangan .= ' memiliki kemampuan yang baik dalam hal ' . $nilaiProjek->capaianProjek->capaianAkhir->name . '. ';
                  } else {
                    $keterangan .= ' memiliki kemampuan yang sangat baik dalam hal ' . $nilaiProjek->capaianProjek->capaianAkhir->name . '. ';
                  }
                }
              }

              CatatanProjek::where('siswa_id', $siswaId)->where('projek_id', $capaianprojek->projek_id)->exists()
              ? CatatanProjek::where('siswa_id', $siswaId)->where('projek_id', $capaianprojek->projek_id)->delete()
              : '';

              CatatanProjek::create([
                'siswa_id' => $siswaId,
                'projek_id' => $capaianprojek->projek_id,
                'keterangan' => $keterangan,
              ]);

              NilaiProjek::create([
                'siswa_id' => $siswaId,
                'capaian_projek_id' => $capaianprojek->id,
                'predikat' => $request->predikat[$i],
              ]);
            }
          }
        }
      DB::commit();
      return response()->json(['success' => 'Data berhasil disimpan!']);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['failed' => 'Terjadi kesalahan. Coba lagi!']);
    }
  }

  public function getCapaianAkhir(CapaianProjek $capaianprojek){
    $capainaAkhir = CapaianAkhir::where('id', $capaianprojek->capaian_akhir_id)->with('subElemen.elemen.dimensi')->first();
    return response()->json(['result' => $capainaAkhir]);
  }

  public function showCatatan(ProjekPilihanKelompok $projekpilihankelompok, Request $request)
  {
    $user = Auth::user();
    if (!$user->isKoordinatorP5() || ($projekpilihankelompok->kelompokprojek->guru->id != $user->guru->id)) {
      abort(403);
    }

    $siswaDiKelompokIni = AnggotaKelompok::where('kelompok_projek_id', $projekpilihankelompok->kelompok_projek_id)->pluck('siswa_id');
    $siswa = Siswa::whereIn('id', $siswaDiKelompokIni)->orderBy('name', 'asc');
    $catatan = CatatanProjek::whereIn('siswa_id', $siswaDiKelompokIni)->where('projek_id', $projekpilihankelompok->projek_id)->get();

    if ($request->ajax()) {

      return DataTables::of($siswa->with('nilaiProjek'))->addIndexColumn()
        ->editColumn('keterangan', function ($q) use ($catatan){
          $keterangan = $catatan->firstWhere('siswa_id', $q->id)['keterangan'] ?? null;
          return view('pages.kelompokprojek.catatanprojek._keterangan')->with([
            'id' => $q->id,
            'keterangan' => $keterangan,
          ]);})
        ->make(true);
    }

    return view('pages.kelompokprojek.catatanprojek.index',[
      'siswa' => $siswa,
      'projekpilihankelompok' => $projekpilihankelompok,
    ]);
  }

  public function updateCatatan(ProjekPilihanKelompok $projekpilihankelompok, Request $request){
    $validasi = Validator::make($request->all(),[
      'siswa_id.*' => 'required|exists:siswas,id',
      'keterangan.*' => 'nullable',
    ]);

    if ($validasi->fails()) {
      return response()->json(['failed' => 'Gagal menyimpan data. Coba lagi!']);
    }

    try {
      DB::beginTransaction();

        foreach ($request->siswa_id as $i => $siswaId) {
          $catatan = CatatanProjek::where('siswa_id', $siswaId)->where('projek_id', $projekpilihankelompok->projek_id);
          if ($catatan->exists()) $catatan->delete();

          if (filled($request->keterangan[$i])) {
            CatatanProjek::create([
              'siswa_id' => $siswaId,
              'projek_id' => $projekpilihankelompok->projek_id,
              'keterangan' => $request->keterangan[$i],
            ]);
          }
        }

      DB::commit();
      return response()->json(['success' => 'Data berhasil disimpan!']);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['failed' => 'Terjadi kesalahan. Coba lagi!']);
    }
  }

}
