<?php

namespace App\Http\Controllers;

use App\Models\KelompokMapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KelompokMapelController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if (Auth::user()->sekolah_id == 0) {
      $data = KelompokMapel::latest();
      $kelompokmapel = KelompokMapel::get();
    }else{
      $kelompokmapel = KelompokMapel::where('sekolah_id',Auth::user()->sekolah_id)->get();
      $data = KelompokMapel::where('sekolah_id',Auth::user()->sekolah_id)->latest();
    }
    if ($request->ajax()) {
      return DataTables::of($data)->addIndexColumn()
                                  ->addColumn('aksi', function($data){
                                      return view('pages.kelompokmapel._aksi')->with('data', $data);})
                                  ->make(true);
    }

    return view('pages.kelompokmapel.index',[
      'kelompokmapel' => $kelompokmapel,
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
      'huruf' => 'required|unique:kelompok_mapels',
      'name' => 'required|unique:kelompok_mapels',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {
      try {
        DB::beginTransaction();
          KelompokMapel::create($request->all());
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
  public function show(KelompokMapel $mapel)
  {
      abort(404);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, KelompokMapel $kelompokmapel)
  {
    if ($request->ajax()) {
      return response()->json(['dataEdit' => $kelompokmapel]);
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
  public function update(Request $request, KelompokMapel $kelompokmapel)
  {
    $validasi = Validator::make($request->all(),[
      'huruf' => 'required|unique:kelompok_mapels,huruf,' . $kelompokmapel->id,
      'name' => 'required|unique:kelompok_mapels,name,' . $kelompokmapel->id,
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {

      try {
        DB::beginTransaction();
          $kelompokmapel->update($request->all());
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
  public function destroy(KelompokMapel $kelompokmapel)
  {
    $success = $kelompokmapel->name . ' berhasil dihapus!';
    $kelompokmapel->delete();
    return response()->json(['success' => $success]);
  }

}
