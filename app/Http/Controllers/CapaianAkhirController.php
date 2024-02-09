<?php

namespace App\Http\Controllers;

use App\Models\CapaianAkhir;
use App\Models\Fase;
use App\Models\SubElemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CapaianAkhirController extends Controller
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
      'sub_elemen_id' => 'required|exists:sub_elemens,id',
      'fase_id' => 'required|exists:fases,id',
      'name' => 'required',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {
      try {
        DB::beginTransaction();
          CapaianAkhir::create($request->all());
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
  public function show(Request $request, SubElemen $capaianakhir)
  {
    $subelemen = $capaianakhir;
    $capaianakhir = CapaianAkhir::where('sub_elemen_id', $subelemen->id)->orderBy('fase_id', 'asc');

    if ($request->ajax()) {

      return DataTables::of($capaianakhir)->addIndexColumn()
        ->editColumn('fase.name', fn($data) => $data->fase->name)
        ->addColumn('aksi', function($capaianakhir){
            return view('pages.targetcapaian.capaianakhir._aksi')->with('capaianakhir', $capaianakhir);})
        ->make(true);
    }

    return view('pages.targetcapaian.capaianakhir.index',[
      'capaianakhir' => $capaianakhir,
      'subelemen' => $subelemen->load('elemen'),
      'fase' => Fase::get(),
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, CapaianAkhir $capaianakhir)
  {
    if ($request->ajax()) {
      return response()->json(['dataEdit' => $capaianakhir]);
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
  public function update(Request $request, CapaianAkhir $capaianakhir)
  {
    $validasi = Validator::make($request->all(),[
      'sub_elemen_id' => 'required|exists:sub_elemens,id',
      'fase_id' => 'required|exists:fases,id',
      'name' => 'required',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {

      try {
        DB::beginTransaction();
          $capaianakhir->update($request->all());
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
  public function destroy(CapaianAkhir $capaianakhir)
  {
    try {
      DB::beginTransaction();
        $success = 'Data berhasil dihapus!';
        $capaianakhir->delete();
      DB::commit();
      return response()->json(['success' => $success]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['failed' => 'Terjadi kesalahan!']);
    }
  }

}
