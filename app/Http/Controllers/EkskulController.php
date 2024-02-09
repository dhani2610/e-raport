<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Guru;
use App\Models\Sekolah;
use App\Models\Tapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EkskulController extends Controller
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
      $data = Ekskul::query();
    } elseif($user->isPembinaEkskul()){
      $data = Ekskul::where('guru_id', $user->guru->id);
    } else {
      abort(403);
    }

    $guru = Guru::orderBy('name', 'asc')->get();
    $tapel = Tapel::get();
  }else{
    if ($user->isAdmin()) {
      $data = Ekskul::where('sekolah_id',Auth::user()->sekolah_id)->query();
    } elseif($user->isPembinaEkskul()){
      $data = Ekskul::where('sekolah_id',Auth::user()->sekolah_id)->where('guru_id', $user->guru->id);
    } else {
      abort(403);
    }
    $guru = Guru::where('sekolah_id',Auth::user()->sekolah_id)->orderBy('name', 'asc')->get();
    $tapel = Tapel::where('sekolah_id',Auth::user()->sekolah_id)->get();

  }

  $sekolah = Sekolah::where('status',1)->get();

    if ($request->ajax()) {

      return DataTables::of($data->with('guru','tapel'))
        ->addIndexColumn()
        ->editColumn('guru.name', fn($data) => $data->pembina())
        ->editColumn('anggotaEkskul.count', fn($data) => $data->anggotaEkskul->count())
        ->addColumn('aksi', function($data){
            return view('pages.ekskul._aksi')->with('data', $data);})
        ->make(true);
    }

    return view('pages.ekskul.index',[
      'sekolah' => $sekolah,
      'ekskul' => $data,
      'guru' => $guru,
      'tapel' => $tapel,
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
      'name' => 'required|unique:ekskuls',
      'tapel_id' => 'required|exists:tapels,id',
      'guru_id' => 'nullable|exists:gurus,id',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {
      try {
        DB::beginTransaction();
          Ekskul::create($request->all());
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
  public function show(Ekskul $ekskul)
  {
      abort(404);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, Ekskul $ekskul)
  {
    if ($request->ajax()) {
      return response()->json(['dataEdit' => $ekskul]);
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
  public function update(Request $request, Ekskul $ekskul)
  {
    $validasi = Validator::make($request->all(),[
      'name' => 'required|unique:ekskuls,name,' . $ekskul->id,
      'tapel_id' => 'required|exists:tapels,id',
      'guru_id' => 'nullable|exists:gurus,id',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {

      try {
        DB::beginTransaction();
          $ekskul->update($request->all());
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
  public function destroy(Ekskul $ekskul)
  {
    $success = 'Ekstrakurikuler: ' . $ekskul->name . ' berhasil dihapus!';
    $ekskul->delete();
    return response()->json(['success' => $success]);
  }

}
