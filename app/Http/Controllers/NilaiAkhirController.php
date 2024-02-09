<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\NilaiAkhir;
use App\Models\Pembelajaran;
use App\Models\PencapaianTp;
use App\Models\Siswa;
use App\Models\TujuanPembelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Yajra\DataTables\Facades\DataTables;

use function Symfony\Component\String\b;

class NilaiAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $data = Pembelajaran::latest();

      if ($request->ajax()) {

        if ($request->mapel_id) $data->where('mapel_id', $request->mapel_id);
        if ($request->kelas_id) $data->where('kelas_id', $request->kelas_id);
        if ($request->guru_id) $data->where('guru_id', $request->guru_id);

        return DataTables::of($data->with('kelas','guru','mapel'))
          ->addIndexColumn()
          ->editColumn('kelas.name', fn($data) => $data->kelas->name)
          ->editColumn('mapel.name', fn($data) => $data->mapel->name)
          ->editColumn('guru.name', fn($data) => $data->guru_pengampu())
          ->addColumn('aksi', function($data){
              return view('pages.nilaiakhir._aksi')->with('data', $data);})
          ->make(true);
      }

      return view('pages.nilaiakhir.index',[
        'pembelajaran' => $data,
        'kelas' => Kelas::get(),
        'mapel' => Mapel::get(),
        'guru' => Guru::get(),
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelajaran $nilaiakhir, Request $request)
    {
      $pembelajaran = $nilaiakhir;

      $user = Auth::user();
      if (!($user->isGuruMapel() && ($user->guru->id == $pembelajaran->guru_id ))) {
        abort(403);
      }
      $data = Siswa::whereHas('user', fn($q) => $q->where('is_aktif', true))->where('kelas_id', $pembelajaran->kelas_id)->orderBy('name', 'asc');
      $nilai = NilaiAkhir::where('pembelajaran_id', $pembelajaran->id)->get();
      $tp = TujuanPembelajaran::where('pembelajaran_id', $pembelajaran->id)->get();

      if ($request->ajax()) {

        return DataTables::of($data->with('pencapaianTp','nilaiAkhir'))
          ->addIndexColumn()
          ->editColumn('nilai', function($data) use($pembelajaran, $nilai){
              $nilaiSiswa = $nilai->firstWhere('siswa_id', $data->id)['nilai'] ?? null;
              return view('pages.nilaiakhir.input.nilai')->with(['data' => $data, 'nilaiSiswa' => $nilaiSiswa]);})
          ->editColumn('pencapaian.optimal', function($data) use($tp) {
              return view('pages.nilaiakhir.input.capaian_optimal')->with(['data' => $data, 'tp' => $tp]);})
          ->editColumn('pencapaian.kurang', function($data) use($tp) {
              return view('pages.nilaiakhir.input.capaian_kurang')->with(['data' => $data, 'tp' => $tp]);})
          ->make(true);
      }

      return view('pages.nilaiakhir.show',[
        'siswa' => $data,
        'pembelajaran' => $pembelajaran,
        'tp' => $tp
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembelajaran $nilaiakhir, Request $request)
    {
      $pembelajaran = $nilaiakhir;
      $user = Auth::user();
      if (!($user->isGuruMapel() && ($user->guru->id == $pembelajaran->guru_id ))) {
        abort(403);
      }
      $data = Siswa::whereHas('user', fn($q) => $q->where('is_aktif', true))->where('kelas_id', $pembelajaran->kelas_id)->orderBy('name', 'asc');
      $nilai = NilaiAkhir::where('pembelajaran_id', $pembelajaran->id)->get();
      if ($request->ajax()) {

        return DataTables::of($data->with('nilaiAkhir'))
        ->addIndexColumn()
          ->editColumn('nilai', function($data) use($nilai){
            $nilaiSiswa = $nilai->firstWhere('siswa_id', $data->id)['nilai'] ?? null;
              return view('pages.nilaiakhir.input.nilai')->with(['data' => $data, 'nilaiSiswa' => $nilaiSiswa]);})
          ->editColumn('deskripsi.optimal', function($data) use($nilai) {
              return view('pages.nilaiakhir.input.deskripsi_optimal')->with(['data' => $data, 'nilai' => $nilai]);})
          ->editColumn('deskripsi.kurang', function($data) use($nilai) {
              return view('pages.nilaiakhir.input.deskripsi_kurang')->with(['data' => $data, 'nilai' => $nilai]);})
          ->make(true);
      }

      return view('pages.nilaiakhir.deskripsicapaian',[
        'siswa' => $data,
        'pembelajaran' => $pembelajaran,
        'nilai' => $nilai
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembelajaran $nilaiakhir)
    // OLD
    // {
    //     $pembelajaran = $nilaiakhir;
    //     $validasi = Validator::make($request->all(),[
    //       'siswa_id.*' => 'required|exists:siswas,id',
    //     ]);

    //     if ($validasi->fails()) {
    //       return back()->withFailed('gagal!');
    //     }

    //     $pluckTp = TujuanPembelajaran::where('pembelajaran_id', $pembelajaran->id)->pluck('id');

    //     foreach($request->siswa_id as $i => $siswaId){
    //       PencapaianTp::where('siswa_id', $siswaId)->whereIn('tujuan_pembelajaran_id', $pluckTp)->delete();

    //       $capaianKurang = "kurang-" . $siswaId;
    //       $capaianOptimal = "optimal-" . $siswaId;
    //       $reqNilai = "nilai-" . $siswaId;

    //       $deskripsiCapaianTinggi = '';
    //       $deskripsiCapaianRendah = '';

    //       if ($request->has($capaianKurang)) {
    //         foreach ($request->$capaianKurang as $a => $kurangValue) {
    //           $lastLoop = count($request->$capaianKurang);
    //           $lastChar = (($a + 1) == $lastLoop) ? '.' : ', ';

    //           PencapaianTp::create([
    //             'siswa_id' => $siswaId,
    //             'tujuan_pembelajaran_id' => $kurangValue,
    //             'status_capaian' => 'kurang',
    //           ]);
    //           $deskripsiCapaianRendah .= TujuanPembelajaran::find($kurangValue)->keterangan . $lastChar;
    //         }

    //       }

    //       if ($request->has($capaianOptimal)) {
    //         foreach ($request->$capaianOptimal as $b => $optimalValue) {
    //         $lastLoop = count($request->$capaianOptimal);
    //         $lastChar = (($b + 1) == $lastLoop) ? '.' : ', ';

    //         PencapaianTp::create([
    //           'siswa_id' => $siswaId,
    //           'tujuan_pembelajaran_id' => $optimalValue,
    //           'status_capaian' => 'optimal',
    //         ]);
    //         $deskripsiCapaianTinggi .= TujuanPembelajaran::find($optimalValue)->keterangan . $lastChar;
    //         }
    //       }

    //       NilaiAkhir::where('siswa_id', $siswaId)->where('pembelajaran_id', $pembelajaran->id)->delete();

    //       if (filled($request->$reqNilai)) {
    //         NilaiAkhir::create([
    //           'siswa_id' => $siswaId,
    //           'pembelajaran_id' => $pembelajaran->id,
    //           'nilai' => $request->$reqNilai ?? null,
    //           'deskripsi_capaian_tinggi' => $request->has($capaianOptimal) ? 'Mencapai Kompetensi dengan sangat baik dalam hal ' . $deskripsiCapaianTinggi : null,
    //           'deskripsi_capaian_rendah' => $request->has($capaianKurang) ? 'Perlu peningkatan dalam hal ' . $deskripsiCapaianRendah : null,
    //         ]);
    //       }

    //     }

    //     return back()->withSuccess('berhasil!');

    // }

    // NEW
    // {
    //   $pembelajaran = $nilaiakhir;
    //   $validasi = Validator::make($request->all(), [
    //       'siswa_id.*' => 'required|exists:siswas,id',
    //   ]);

    //   if ($validasi->fails()) {
    //       return back()->withFailed('gagal!');
    //   }

    //   $pluckTp = TujuanPembelajaran::where('pembelajaran_id', $pembelajaran->id)->pluck('id');

    //   try {
    //       DB::beginTransaction();

    //       foreach ($request->siswa_id as $siswaId) {

    //           // CAPAIAN
    //           PencapaianTp::where('siswa_id', $siswaId)->whereIn('tujuan_pembelajaran_id', $pluckTp)->delete();
    //           $capaianKurang = "kurang-" . $siswaId;
    //           $capaianOptimal = "optimal-" . $siswaId;
    //           $this->createPencapaian($siswaId, $request->input($capaianKurang, []), 'kurang');
    //           $this->createPencapaian($siswaId, $request->input($capaianOptimal, []), 'optimal');

    //       }

    //       DB::commit();

    //       return back()->withSuccess('berhasil!');
    //   } catch (\Exception $e) {
    //       DB::rollBack();
    //       return back()->withFailed('Terjadi kesalahan!');
    //   }
    // }

    // NEW 2
    {
      $pembelajaran = $nilaiakhir;

      $validasi = Validator::make($request->all(), [
          'siswa_id.*' => 'required|exists:siswas,id',
      ]);

      if ($validasi->fails()) {
          return response()->json(['failed' => 'Terjadi kesalahan, periksa kembali formulir!']);
      }

      $pluckTp = TujuanPembelajaran::where('pembelajaran_id', $pembelajaran->id)->pluck('id');

      try {
        DB::beginTransaction();
          foreach ($request->siswa_id as $i => $siswaId) {
            PencapaianTp::where('siswa_id', $siswaId)->whereIn('tujuan_pembelajaran_id', $pluckTp)->delete();

            $capaianKurang = "kurang-" . $siswaId;
            $capaianOptimal = "optimal-" . $siswaId;
            $reqNilai = "nilai-" . $siswaId;

            $deskripsiCapaianTinggi = collect($request->$capaianOptimal)->map(function ($optimalValue) {
                return TujuanPembelajaran::find($optimalValue)->keterangan;
            })->implode(', ');

            $deskripsiCapaianRendah = collect($request->$capaianKurang)->map(function ($kurangValue) {
                return TujuanPembelajaran::find($kurangValue)->keterangan;
            })->implode(', ');

            if ($request->has($capaianKurang)) {
                foreach ($request->$capaianKurang as $a => $kurangValue) {
                    PencapaianTp::create([
                        'siswa_id' => $siswaId,
                        'tujuan_pembelajaran_id' => $kurangValue,
                        'status_capaian' => 'kurang',
                    ]);
                }
            }

            if ($request->has($capaianOptimal)) {
                foreach ($request->$capaianOptimal as $b => $optimalValue) {
                    PencapaianTp::create([
                        'siswa_id' => $siswaId,
                        'tujuan_pembelajaran_id' => $optimalValue,
                        'status_capaian' => 'optimal',
                    ]);
                }
            }

            NilaiAkhir::where('siswa_id', $siswaId)->where('pembelajaran_id', $pembelajaran->id)->delete();

            if ($request->$reqNilai !== null) {
                NilaiAkhir::create([
                    'siswa_id' => $siswaId,
                    'pembelajaran_id' => $pembelajaran->id,
                    'nilai' => $request->$reqNilai,
                    'deskripsi_capaian_tinggi' => $request->has($capaianOptimal) ? 'Mencapai Kompetensi dengan sangat baik dalam hal ' . $deskripsiCapaianTinggi : null,
                    'deskripsi_capaian_rendah' => $request->has($capaianKurang) ? 'Perlu peningkatan dalam hal ' . $deskripsiCapaianRendah : null,
                ]);
            }
          }
        DB::commit();
        return response()->json(['success' => 'Data berhasil diperbarui!']);
      } catch (\Throwable $th) {
        DB::rollBack();
        return response()->json(['failed' => 'Terjadi kesalahan, periksa kembali formulir!']);
      }

    }

    public function updateDeskripsi(Pembelajaran $pembelajaran, Request $request)
     {
        $validasi = Validator::make($request->all(),[
          'siswa_id.*' => 'required|exists:siswas,id',
        ]);

        if ($validasi->fails()) {
          return response()->json(['failed' => 'Terjadi kesalahan, periksa kembali formulir!']);
        }

        try {
          DB::beginTransaction();
            foreach($request->siswa_id as $i => $siswaId){
              $reqNilai = "nilai-" . $siswaId;
              $deskripsiKurang = "deskripsi-capaian-kurang-" . $siswaId;
              $deskripsiOptimal = "deskripsi-capaian-optimal-" . $siswaId;

              NilaiAkhir::where('siswa_id', $siswaId)->where('pembelajaran_id', $pembelajaran->id)->delete();

              if (filled($request->$reqNilai)) {
                NilaiAkhir::create([
                  'siswa_id' => $siswaId,
                  'pembelajaran_id' => $pembelajaran->id,
                  'nilai' => $request->$reqNilai,
                  'deskripsi_capaian_tinggi' => $request->$deskripsiOptimal,
                  'deskripsi_capaian_rendah' => $request->$deskripsiKurang,
                ]);
              }

            }
          DB::commit();
          return response()->json(['success' => 'Data berhasil diperbarui!']);
        } catch (\Throwable $th) {
          DB::rollBack();
          return response()->json(['failed' => 'Terjadi kesalahan, periksa kembali formulir!']);
        }

    }

    private function createPencapaian($siswaId, $values, $statusCapaian)
    {
        foreach ($values as $value) {
            PencapaianTp::create([
              'siswa_id' => $siswaId,
              'tujuan_pembelajaran_id' => $value,
              'status_capaian' => $statusCapaian,
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
