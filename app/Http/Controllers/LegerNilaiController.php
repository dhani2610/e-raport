<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\NilaiAkhir;
use App\Models\Pembelajaran;
use App\Models\Siswa;
use App\Models\Tingkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LegerNilaiController extends Controller
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
        $data = Kelas::latest();
      } elseif($user->isWaliKelas()){
        $data = Kelas::where('guru_id', $user->guru->id);
      } else {
        abort(403);
      }
    }else{
      if ($user->isAdmin()) {
        $data = Kelas::where('sekolah_id',Auth::user()->sekolah_id)->latest();
      } elseif($user->isWaliKelas()){
        $data = Kelas::where('sekolah_id',Auth::user()->sekolah_id)->where('guru_id', $user->guru->id);
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
                                          return view('pages.leger._aksi')->with('kelasId', $data->id);})
                                      ->make(true);
        }

        return view('pages.leger.index',[
          'kelas' => $data,
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
    public function show(Request $request, Kelas $leger)
    {
        $kelas = $leger;

        $user = Auth::user();
        if (!$user->isAdmin() && !($user->isWaliKelas() && ($kelas->id == $user->guru->kelas->id))) {
          abort(403);
        }

        $pembelajarans = Pembelajaran::where('kelas_id', $kelas->id)->get();

        $siswas = Siswa::where('kelas_id', $kelas->id)->whereHas('user', fn($q) => $q->where('is_aktif', true))->orderBy('name', 'asc')->get();

        $nilaiSiswa = [];

        foreach ($siswas as $siswa) {
          $totalNilai = 0;
          $jumlahPembelajaran = count($pembelajarans);
          $nilaiSiswa[$siswa->id] = ['siswa' => $siswa, 'totalNilai' => $totalNilai, 'rataRata' => 0];

          foreach ($pembelajarans as $pembelajaran) {
              $nilai = NilaiAkhir::where('siswa_id', $siswa->id)
                  ->where('pembelajaran_id', $pembelajaran->id)
                  ->first();
              $nilaiSiswa[$siswa->id]['totalNilai'] += $nilai ? $nilai->nilai : 0;
              $nilaiSiswa[$siswa->id][$pembelajaran->id] = $nilai ? $nilai->nilai : '-';
          }

          // $nilaiSiswa[$siswa->id]['rataRata'] = $jumlahPembelajaran > 0 ? $nilaiSiswa[$siswa->id]['totalNilai'] / $jumlahPembelajaran : 0;
          $nilaiSiswa[$siswa->id]['rataRata'] = $jumlahPembelajaran > 0 ? round($nilaiSiswa[$siswa->id]['totalNilai'] / $jumlahPembelajaran, 1) : 0;
        }

        // Urutkan siswa berdasarkan total nilai dari yang tertinggi ke yang terendah
        usort($nilaiSiswa, function ($a, $b) {
            return $b['totalNilai'] - $a['totalNilai'];
        });

        // Atur peringkat untuk setiap siswa
        $peringkat = 1;
        foreach ($nilaiSiswa as &$siswa) {
            $siswa['peringkat'] = $peringkat++;
        }

        $title = 'LEGER NILAI ' . $kelas->name;
        return view('pages.leger.show', compact('kelas', 'pembelajarans', 'nilaiSiswa', 'title'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
