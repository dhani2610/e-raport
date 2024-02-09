<?php

namespace App\Http\Controllers;

use App\Models\Dimensi;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DimensiController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if (Auth::user()->sekolah_id == 0) {
      $dimensi = Dimensi::query();
    }else{
      $dimensi = Dimensi::where('sekolah_id',Auth::user()->sekolah_id)->query();
    }

    $sekolah = Sekolah::where('status',1)->get();

    if ($request->ajax()) {

      return DataTables::of($dimensi->with('elemen')->withCount('elemen'))->addIndexColumn()
        ->editColumn('elemen.count', fn($dimensi) => $dimensi->elemen_count)
        ->addColumn('aksi', function($dimensi){
            return view('pages.targetcapaian.dimensi._aksi')->with('dimensi', $dimensi);})
        ->make(true);
    }

    return view('pages.targetcapaian.dimensi.index',[
      'dimensi' => $dimensi,
      'sekolah' => $sekolah,
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
      'name' => 'required',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {
      try {
        DB::beginTransaction();
          Dimensi::create($request->all());
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
  public function show(Dimensi $dimensi)
  {
      abort(404);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, Dimensi $dimensi)
  {
    if ($request->ajax()) {
      return response()->json(['dataEdit' => $dimensi]);
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
  public function update(Request $request, Dimensi $dimensi)
  {
    $validasi = Validator::make($request->all(),[
      'name' => 'required',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {

      try {
        DB::beginTransaction();
          $dimensi->update($request->all());
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
  public function destroy(Dimensi $dimensi)
  {
    try {
      DB::beginTransaction();
        $success = $dimensi->name . ' berhasil dihapus!';
        $dimensi->delete();
      DB::commit();
      return response()->json(['success' => $success]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['failed' => 'Terjadi kesalahan!']);
    }
  }

}
