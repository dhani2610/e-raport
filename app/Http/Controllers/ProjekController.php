<?php

namespace App\Http\Controllers;

use App\Models\Fase;
use App\Models\Projek;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProjekController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if (Auth::user()->sekolah_id == 0) {
      $projek = Projek::latest();
    }else{
      $projek = Projek::where('sekolah_id',Auth::user()->sekolah_id)->latest();
    }

    if ($request->ajax()) {

      if ($request->fase_id) $projek->where('fase_id', $request->fase_id);

      return DataTables::of($projek->with('capaianProjek','fase'))->addIndexColumn()
        ->editColumn('fase.name', fn($projek) => $projek->fase->name)
        // ->editColumn('capaianprojek.count', fn($projek) => $projek->capaianProjek->count())
        ->editColumn('deskripsi', fn($projek) => Str::limit($projek->deskripsi, 40))
        ->addColumn('aksi', function($projek){
            return view('pages.projek._aksi')->with('projek', $projek);})
        ->make(true);
    }
    $sekolah = Sekolah::where('status',1)->get();


    return view('pages.projek.index',[
      'sekolah' => $sekolah,
      'projek' => $projek,
      'fase' => Fase::get(),
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
      'fase_id' => 'required|exists:fases,id',
      'tema' => 'required',
      'name' => 'required',
      'deskripsi' => 'required',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {
      try {
        DB::beginTransaction();
          Projek::create($request->all());
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
  public function show(Projek $projek)
  {
    $projek->load('fase:id,name', 'capaianProjek', 'projekPilihanKelompok');
    return response()->json(['result' => $projek]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, Projek $projek)
  {
    if ($request->ajax()) {
      return response()->json(['dataEdit' => $projek]);
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
  public function update(Request $request, Projek $projek)
  {
    $validasi = Validator::make($request->all(),[
      'fase_id' => 'required|exists:fases,id',
      'tema' => 'required',
      'name' => 'required',
      'deskripsi' => 'required',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {

      try {
        DB::beginTransaction();
          $projek->update($request->all());
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
  public function destroy(Projek $projek)
  {
    try {
      DB::beginTransaction();
        $success = $projek->name . ' berhasil dihapus!';
        $projek->delete();
      DB::commit();
      return response()->json(['success' => $success]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['failed' => 'Terjadi kesalahan!']);
    }
  }

}
