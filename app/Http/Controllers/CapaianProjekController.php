<?php

namespace App\Http\Controllers;

use App\Models\CapaianAkhir;
use App\Models\CapaianProjek;
use App\Models\Projek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CapaianProjekController extends Controller
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
    $exists = CapaianProjek::where('projek_id', $request->projek_id)->pluck('capaian_akhir_id');
    $capaianakhir = CapaianAkhir::where('fase_id', Projek::find($request->projek_id)->fase_id)->whereNotIn('id', $exists);

    if ($request->ajax()) {

      return DataTables::of($capaianakhir->with('subElemen.elemen.dimensi', 'fase'))->addIndexColumn()
        ->editColumn('fase', fn($capaianakhir) => $capaianakhir->fase->name)
        ->editColumn('dimensi', fn($capaianakhir) => $capaianakhir->subElemen->elemen->dimensi->name)
        ->editColumn('elemen', fn($capaianakhir) => $capaianakhir->subElemen->elemen->name)
        ->editColumn('subelemen', fn($capaianakhir) => $capaianakhir->subElemen->name)
        ->addColumn('add', function($capaianakhir){
            return view('pages.projek.capaianprojek._add')->with('id', $capaianakhir->id);})
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
      'projek_id' => 'required|exists:projeks,id',
      'capaian_akhir_id' => 'required|exists:capaian_akhirs,id',
    ]);

    if ($validasi->fails()) {
      return response()->json(['failed' => 'Gagal menambahkan!']);
    } elseif(CapaianProjek::where('projek_id', $request->projek_id)->where('capaian_akhir_id', $request->capaian_akhir_id)->exists()) {
      return response()->json(['failed' => 'Capaian Projek tersebut sudah ditambahkan!']);
    } else {
      try {
        DB::beginTransaction();
          CapaianProjek::create($request->all());
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
  public function show(Projek $capaianprojek, Request $request)
  {
    $projek = $capaianprojek;
    $capaianprojek = CapaianProjek::where('projek_id', $projek->id);

    if ($request->ajax()) {

      return DataTables::of($capaianprojek->with('capaianAkhir.fase', 'capaianAkhir.subElemen.elemen.dimensi'))->addIndexColumn()
        ->editColumn('fase', fn($capaianprojek) => $capaianprojek->capaianAkhir->fase->name)
        ->editColumn('dimensi', fn($capaianprojek) => $capaianprojek->capaianAkhir->subElemen->elemen->dimensi->name)
        ->editColumn('elemen', fn($capaianprojek) => $capaianprojek->capaianAkhir->subElemen->elemen->name)
        ->editColumn('subelemen', fn($capaianprojek) => $capaianprojek->capaianAkhir->subElemen->name)
        ->addColumn('delete', function($capaianprojek){
            return view('pages.projek.capaianprojek._delete')->with('id', $capaianprojek->id);})
        ->make(true);
    }

    return view('pages.projek.capaianprojek.index',[
      'capaianprojek' => $capaianprojek,
      'projek' => $projek,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, CapaianProjek $capaianprojek)
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
  public function update(Request $request, CapaianProjek $capaianprojek)
  {
    abort(404);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(CapaianProjek $capaianprojek)
  {
    try {
      DB::beginTransaction();
        $success = 'Data berhasil dihapus!';
        $capaianprojek->delete();
      DB::commit();
      return response()->json(['success' => $success]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['failed' => 'Terjadi kesalahan!']);
    }
  }

}
