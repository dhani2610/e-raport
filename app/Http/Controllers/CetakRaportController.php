<?php

namespace App\Http\Controllers;

use App\Models\AnggotaEkskul;
use App\Models\CapaianAkhir;
use App\Models\CapaianProjek;
use App\Models\CatatanWalas;
use App\Models\Dimensi;
use App\Models\Kelas;
use App\Models\KelompokMapel;
use App\Models\Ketidakhadiran;
use App\Models\NilaiAkhir;
use App\Models\Pembelajaran;
use App\Models\Projek;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\Tingkat;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CetakRaportController extends Controller
{
    public function index(Request $request)
    {
      $user = Auth::user();
    if (Auth::user()->sekolah_id == 0) {
      if ($user->isAdmin()) {
        $data = Kelas::latest();
      } elseif($user->isWaliKelas()){
        $data = Kelas::where('guru_id', $user->guru->id);
      } elseif($user->isSiswa()){
        $data = Kelas::where('id', $user->siswa->kelas_id);
      } else {
        abort(403);
      }
    }else{
      if ($user->isAdmin()) {
        $data = Kelas::where('sekolah_id',Auth::user()->sekolah_id)->latest();
      } elseif($user->isWaliKelas()){
        $data = Kelas::where('sekolah_id',Auth::user()->sekolah_id)->where('guru_id', $user->guru->id);
      } elseif($user->isSiswa()){
        $data = Kelas::where('sekolah_id',Auth::user()->sekolah_id)->where('id', $user->siswa->kelas_id);
      } else {
        abort(403);
      }
    }

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
                                        return view('pages.cetakrapor._aksi')->with('kelasId', $data->id);})
                                    ->make(true);
      }

      return view('pages.cetakrapor.index',[
        'kelas' => $data,
        'tingkat' => Tingkat::get(),
      ]);
    }

    public function show(Request $request, Kelas $cetakrapor){
      $kelas = $cetakrapor;

      if (Auth::user()->isAdmin()) {
        $data = Siswa::where('kelas_id', $kelas->id)->whereHas('user', fn($q) => $q->where('is_aktif', true))->orderBy('name', 'asc');
      } elseif (Auth::user()->isWaliKelas() && ($kelas->id == Auth::user()->guru->kelas->id)){
        $data = Siswa::where('kelas_id', $kelas->id)->whereHas('user', fn($q) => $q->where('is_aktif', true))->orderBy('name', 'asc');
      } elseif (Auth::user()->isSiswa() && ($kelas->id == Auth::user()->siswa->kelas_id)) {
        $data = Siswa::where('id', Auth::user()->siswa->id)->whereHas('user', fn($q) => $q->where('is_aktif', true));
      } else {
        abort(403);
      }

      if ($request->ajax()) {
        return DataTables::of($data->with('kelas'))->addIndexColumn()
                                    ->editColumn('nis-nisn', function($data){
                                      return $data->nis . '/' . $data->nisn;
                                    })
                                    ->addColumn('aksi', function($data){
                                      return view('pages.cetakrapor._aksishow')->with('siswaId', $data->id);
                                    })
                                    ->make(true);
        }

      return view('pages.cetakrapor.show', [
        'siswa' => $data,
        'kelas' => $kelas,
      ]);
    }

    public function kelengkapan(Siswa $siswa, $paper) {

      if
      (
        !Auth::user()->isAdmin() &&
        !(Auth::user()->isWaliKelas() && ($siswa->kelas_id == Auth::user()->guru->kelas->id)) &&
        !(Auth::user()->isSiswa() && ($siswa->id == Auth::user()->siswa->id))
      )
      {
        abort(403);
      }

      return PDF::loadview('pages.cetakrapor.kelengkapan.print',[
        'siswa' => $siswa,
        'sekolah' => Sekolah::first(),
      ])->setPaper($paper, 'Potrait')->stream('KELENGKAPAN RAPOR - ' . $siswa->name . ' ' . $siswa->kelas->name . ' ' . $siswa->nis . '.pdf');
    }

    public function p5(Siswa $siswa, $paper) {
      if
      (
        !Auth::user()->isAdmin() &&
        !(Auth::user()->isWaliKelas() && ($siswa->kelas_id == Auth::user()->guru->kelas->id)) &&
        !(Auth::user()->isSiswa() && ($siswa->id == Auth::user()->siswa->id))
      )
      {
        abort(403);
      }

      if (!$siswa->anggotaKelompok) {
        return back()->withWarning($siswa->name . ' belum memiliki Projek!');
      }

      $projekId = $siswa->anggotaKelompok->kelompokProjek->projekPilihanKelompok->pluck('projek_id');
      $projek = Projek::whereIn('id', $projekId)->get();
      $capaianProjek =  CapaianProjek::whereIn('projek_id', $projekId)->get();

      $dimensi = Dimensi::select('dimensis.*')
      ->join('elemens', 'dimensis.id', '=', 'elemens.dimensi_id')
      ->join('sub_elemens', 'elemens.id', '=', 'sub_elemens.elemen_id')
      ->join('capaian_akhirs', 'sub_elemens.id', '=', 'capaian_akhirs.sub_elemen_id')
      ->join('capaian_projeks', 'capaian_akhirs.id', '=', 'capaian_projeks.capaian_akhir_id')
      ->whereIn('capaian_projeks.projek_id', $projekId)
      ->distinct('dimensis.id')
      ->get();

      return PDF::loadview('pages.cetakrapor.p5.print',[
        'siswa' => $siswa,
        'sekolah' => Sekolah::first(),
        'projek' => $projek,
        'dimensi' => $dimensi,
        'capaianprojek' => $capaianProjek,
        'centang' => '√',
      ])->setPaper($paper, 'Potrait')->stream('RAPOR PROJEK - ' . $siswa->name . ' ' . $siswa->kelas->name . ' ' . $siswa->nis . '.pdf');
    }

    public function semester(Siswa $siswa, $paper) {
      if
      (
        !Auth::user()->isAdmin() &&
        !(Auth::user()->isWaliKelas() && ($siswa->kelas_id == Auth::user()->guru->kelas->id)) &&
        !(Auth::user()->isSiswa() && ($siswa->id == Auth::user()->siswa->id))
      )
      {
        abort(403);
      }
      $kelMapelId = $siswa->kelas->pembelajaran->pluck('mapel.kelompok_mapel_id')->unique();
      return PDF::loadview('pages.cetakrapor.semester.print2',[
        'siswa' => $siswa,
        'sekolah' => Sekolah::first(),
        'kelompokmapel' => KelompokMapel::whereIn('id', $kelMapelId)->get(),
        'pembelajaran' => Pembelajaran::where('kelas_id', $siswa->kelas_id)->get(),
        'nilaiakhir' => NilaiAkhir::where('siswa_id', $siswa->id)->whereIn('pembelajaran_id', $siswa->kelas->pembelajaran->pluck('id')),
        'anggotaEkskul' => AnggotaEkskul::where('siswa_id', $siswa->id)->get(),
        'ketidakhadiran' => Ketidakhadiran::where('siswa_id', $siswa->id)->get(),
        'catatanwalas' => CatatanWalas::where('siswa_id', $siswa->id)->get(),
      ])->setPaper($paper, 'Potrait')->stream('RAPOR HASIL BELAJAR - ' . $siswa->name . ' ' . $siswa->kelas->name . ' ' . $siswa->nis . '.pdf');
    }
}
