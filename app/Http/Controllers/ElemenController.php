<?php

namespace App\Http\Controllers;

use App\Models\Dimensi;
use App\Models\Elemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ElemenController extends Controller
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
      'dimensi_id' => 'required|exists:dimensis,id',
      'name' => 'required',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {
      try {
        DB::beginTransaction();
          Elemen::create($request->all());
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
  public function show(Request $request, Dimensi $elemen)
  {
    $dimensi = $elemen;
    $elemen = Elemen::where('dimensi_id', $dimensi->id);

    if ($request->ajax()) {

      return DataTables::of($elemen->with('subElemen')->withCount('subElemen'))->addIndexColumn()
        ->editColumn('subelemen.count', fn($elemen) => $elemen->subElemen->count())
        ->addColumn('aksi', function($elemen){
            return view('pages.targetcapaian.elemen._aksi')->with('elemen', $elemen);})
        ->make(true);
    }

    return view('pages.targetcapaian.elemen.index',[
      'elemen' => $elemen,
      'dimensi' => $dimensi,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, Elemen $elemen)
  {
    if ($request->ajax()) {
      return response()->json(['dataEdit' => $elemen]);
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
  public function update(Request $request, Elemen $elemen)
  {
    $validasi = Validator::make($request->all(),[
      'dimensi_id' => 'required|exists:dimensis,id',
      'name' => 'required',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {

      try {
        DB::beginTransaction();
          $elemen->update($request->all());
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
  public function destroy(Elemen $elemen)
  {
    try {
      DB::beginTransaction();
        $success = $elemen->name . ' berhasil dihapus!';
        $elemen->delete();
      DB::commit();
      return response()->json(['success' => $success]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['failed' => 'Terjadi kesalahan!']);
    }
  }

}
