<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use App\Models\TujuanPembelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Yajra\DataTables\Facades\DataTables;

class TujuanPembelajaranController extends Controller
{
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
            return view('pages.tujuanpembelajaran._aksi')->with('data', $data);})
        ->make(true);
    }

    return view('pages.tujuanpembelajaran.index',[
      'pembelajaran' => $data,
      'kelas' => Kelas::get(),
      'mapel' => Mapel::get(),
      'guru' => Guru::get(),
    ]);
  }

  public function store(Request $request)
  {
    try {
      DB::beginTransaction();
        foreach ($request->keterangan as $i => $keterangan) {
          if (filled($request->keterangan[$i])) {
            TujuanPembelajaran::create([
              'pembelajaran_id' => $request->pembelajaran_id,
              'keterangan' => $request->keterangan[$i],
            ]);
          }
        }
      DB::commit();
      return response()->json(['success' => 'Berhasil ditambahkan!', 'req' => $request->all()]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['failed' => 'Terjadi kesalahan!']);
    }
  }

  public function show(Pembelajaran $tujuanpembelajaran, Request $request)
  {
    $user = Auth::user();
    if (!($user->isGuruMapel() && ($user->guru->id == $tujuanpembelajaran->guru_id ))) {
      abort(403);
    }

    $pembelajaran = $tujuanpembelajaran;
    $data = TujuanPembelajaran::where('pembelajaran_id', $pembelajaran->id);

    if ($request->ajax()) {

      return DataTables::of($data->with('pembelajaran'))
        ->addIndexColumn()
        ->editColumn('keterangan', function($data){
            return view('pages.tujuanpembelajaran.kelola.input._keterangan')->with('data', $data);})
        ->addColumn('aksi', function($data){
            return view('pages.tujuanpembelajaran.kelola.input._hapus')->with('data', $data);})
        ->make(true);
    }

    return view('pages.tujuanpembelajaran.kelola.show',[
      'tujuanpembelajaran' => $data,
      'pembelajaran' => $pembelajaran,
    ]);
  }

  public function update(Pembelajaran $tujuanpembelajaran, Request $request)
  {
    $pembelajaran = $tujuanpembelajaran;
    try {
      DB::beginTransaction();
        foreach ($request->id as $i => $id) {
          TujuanPembelajaran::find($id)->update([
            'keterangan' => $request->keterangan[$i],
          ]);
        }
      DB::commit();
      return response()->json(['success' => 'Berhasil diperbarui!']);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['failed' => 'Terjadi kesalahan!']);
    }
  }

  public function delete(TujuanPembelajaran $tujuanpembelajaran)
  {
    try {
      DB::beginTransaction();
        $tujuanpembelajaran->delete();
      DB::commit();
      return response()->json(['success' => 'Berhasil dihapus!']);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['failed' => 'Terjadi kesalahan!']);
    }
  }

}
