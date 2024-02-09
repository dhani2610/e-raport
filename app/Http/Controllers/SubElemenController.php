<?php

namespace App\Http\Controllers;

use App\Models\Elemen;
use App\Models\SubElemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SubElemenController extends Controller
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
      'elemen_id' => 'required|exists:elemens,id',
      'name' => 'required',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {
      try {
        DB::beginTransaction();
          SubElemen::create($request->all());
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
  public function show(Request $request, Elemen $subelemen)
  {
    $elemen = $subelemen;
    $subelemen = SubElemen::where('elemen_id', $elemen->id);

    if ($request->ajax()) {

      return DataTables::of($subelemen->with('capaianAkhir'))->addIndexColumn()
        ->editColumn('capaianakhir.count', fn($elemen) => $elemen->capaianAkhir->count())
        ->addColumn('aksi', function($subelemen){
            return view('pages.targetcapaian.subelemen._aksi')->with('subelemen', $subelemen);})
        ->make(true);
    }

    return view('pages.targetcapaian.subelemen.index',[
      'subelemen' => $subelemen,
      'elemen' => $elemen->load('dimensi'),
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, SubElemen $subelemen)
  {
    if ($request->ajax()) {
      return response()->json(['dataEdit' => $subelemen]);
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
  public function update(Request $request, SubElemen $subelemen)
  {
    $validasi = Validator::make($request->all(),[
      'elemen_id' => 'required|exists:elemens,id',
      'name' => 'required',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {

      try {
        DB::beginTransaction();
          $subelemen->update($request->all());
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
  public function destroy(SubElemen $subelemen)
  {
    try {
      DB::beginTransaction();
        $success = $subelemen->name . ' berhasil dihapus!';
        $subelemen->delete();
      DB::commit();
      return response()->json(['success' => $success]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['failed' => 'Terjadi kesalahan!']);
    }
  }

}
