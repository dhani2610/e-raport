<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Ketidakhadiran;
use App\Models\Siswa;
use App\Models\Tapel;
use App\Models\Tingkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KetidakhadiranController extends Controller
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
                                          return view('pages.ketidakhadiran._aksi')->with('data', $data);})
                                      ->make(true);
        }

        return view('pages.ketidakhadiran.index',[
          'kelas' => $data,
          'guru' => Guru::select('id','name')->get(),
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

        if ($request->ajax()) {
          return DataTables::of($data->with('ketidakhadiran', 'kelas'))->addIndexColumn()
                                      ->editColumn('ketidakhadiran.sakit', function($data){
                                        $sakit = $data->ketidakhadiran ? $data->ketidakhadiran->sakit : null;
                                        return view('pages.ketidakhadiran._sakit')->with(['sakit' => $sakit, 'id' => $data->id]);
                                      })
                                      ->editColumn('ketidakhadiran.izin', function($data){
                                        $izin = $data->ketidakhadiran ? $data->ketidakhadiran->izin : null;
                                        return view('pages.ketidakhadiran._izin')->with(['izin' => $izin, 'id' => $data->id]);
                                      })
                                      ->editColumn('ketidakhadiran.tk', function($data){
                                        $tk = $data->ketidakhadiran ? $data->ketidakhadiran->tk : null;
                                        return view('pages.ketidakhadiran._tk')->with(['tk' => $tk, 'id' => $data->id]);
                                      })
                                      ->make(true);
        }

        return view('pages.ketidakhadiran.show',[
          'siswa' => $data,
          'kelas' => Kelas::whereId($id)->first(),
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
            if ($siswa->ketidakhadiran) {
              $siswa->ketidakhadiran->update([
                'sakit' => $request->sakit[$i] == 0 ? null : $request->sakit[$i],
                'izin' => $request->izin[$i] == 0 ? null : $request->izin[$i],
                'tk' => $request->tk[$i] == 0 ? null : $request->tk[$i],
              ]);
            } else {
              Ketidakhadiran::create([
                'siswa_id' => $siswaId,
                'sakit' => $request->sakit[$i] == 0 ? null : $request->sakit[$i],
                'izin' => $request->izin[$i] == 0 ? null : $request->izin[$i],
                'tk' => $request->tk[$i] == 0 ? null : $request->tk[$i],
              ]);
            }
          }
        DB::commit();
        return response()->json(['success' => 'Ketidakhadiran berhasil diperbarui!']);
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
