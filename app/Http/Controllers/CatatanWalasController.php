<?php

namespace App\Http\Controllers;

use App\Models\CatatanWalas;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tingkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CatatanWalasController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $user = Auth::user();
      if($user->isWaliKelas()){
        $data = Kelas::where('guru_id', $user->guru->id);
      } else {
        abort(403);
      }

      if ($request->ajax()) {

        if ($request->tingkat_id) $data->where('tingkat_id', $request->tingkat_id);

        return DataTables::of($data->with('tingkat:id,angka','siswa:id,kelas_id'))->addIndexColumn()
                                    ->editColumn('tingkat.angka', function($data){
                                      return $data->tingkat->angka;})
                                    ->editColumn('guru.name', function($data){
                                      return $data->wali_kelas();})
                                    ->editColumn('siswa.count', function($data){
                                      return $data->siswaAktifKelasCount($data->id);})
                                    ->addColumn('aksi', function($data){
                                        return view('pages.catatanwalas._aksi')->with('data', $data);})
                                    ->make(true);
      }

      return view('pages.catatanwalas.index',[
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
  public function show(Request $request, $id)
  {
      $user = Auth::user();
      if (!($user->isWaliKelas() && ($user->guru->id == Kelas::find($id)->guru_id ))) {
        abort(403);
      }

      $data = Siswa::whereHas('user', fn($q) => $q->where('is_aktif', true))->where('kelas_id', $id)->orderBy('name', 'ASC');

      $kelas = Kelas::whereId($id)->first();
      if ($kelas->tingkat->angka == 6 || $kelas->tingkat->angka == 9 || $kelas->tingkat->angka == 12) {
        $naikTingkat = [
          [ 'key' => 'LULUS', 'value' => '1', ],
          [ 'key' => 'TIDAK LULUS', 'value' => '0', ],
        ];
      } else {
        $naikTingkat = [
          [ 'key' => 'NAIK KELAS', 'value' => '1', ],
          [ 'key' => 'TINGGAL DI KELAS', 'value' => '0', ],
        ];
      }

      if ($request->ajax()) {
        if ($request->semester == 1) {
          return DataTables::of($data->with('catatanWalas', 'kelas'))->addIndexColumn()
            ->editColumn('catatanwalas.catatan', function($data){
              $catatan = $data->catatanWalas ? $data->catatanWalas->catatan : null;
              return view('pages.catatanwalas._catatan')->with(['catatan' => $catatan, 'id' => $data->id]);
            })
            ->make(true);
        } else {
          return DataTables::of($data->with('catatanWalas', 'kelas'))->addIndexColumn()
            ->editColumn('catatanwalas.catatan', function($data){
              $catatan = $data->catatanWalas ? $data->catatanWalas->catatan : null;
              return view('pages.catatanwalas._catatan')->with(['catatan' => $catatan, 'id' => $data->id]);
            })
            ->editColumn('catatanwalas.naik_tingkat', function($data) use($naikTingkat){
              $naik_tingkat = $data->catatanWalas ? $data->catatanWalas->naik_tingkat : null;
              return view('pages.catatanwalas._naik_tingkat')->with(['naik_tingkat' => $naik_tingkat, 'id' => $data->id, 'naikTingkat' => $naikTingkat]);
            })
            ->make(true);

        }
      }

      return view('pages.catatanwalas.show',[
        'siswa' => $data,
        'kelas' => $kelas,
        'naikTingkat' => $naikTingkat,
      ]);
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
    try {
      DB::beginTransaction();
        foreach ($request->siswa_id as $i => $siswaId) {
          $siswa = Siswa::find($siswaId);
          if ($siswa->catatanWalas) {
            $siswa->catatanWalas->update([
              'catatan' => $request->catatan[$i],
              'naik_tingkat' => $request->naik_tingkat[$i] ?? null,
            ]);
          } else {
            CatatanWalas::create([
              'siswa_id' => $siswaId,
              'catatan' => $request->catatan[$i],
              'naik_tingkat' => $request->naik_tingkat[$i] ?? null,
            ]);
          }
        }
      DB::commit();
      return response()->json(['success' => 'Catatan Wali Kelas berhasil diperbarui!']);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['failed' => 'Terjadi kesalahan!']);
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
