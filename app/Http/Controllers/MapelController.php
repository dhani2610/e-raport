<?php

namespace App\Http\Controllers;

use App\Models\KelompokMapel;
use App\Models\Mapel;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MapelController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    
    if (Auth::user()->sekolah_id == 0) {
      $data = Mapel::latest();
    }else{
      $data = Mapel::where('sekolah_id',Auth::user()->sekolah_id)->latest();
    }
    $sekolah = Sekolah::where('status',1)->get();


    if ($request->ajax()) {

      if ($request->kelompok_mapel_id) $data->where('kelompok_mapel_id', $request->kelompok_mapel_id);

      return DataTables::of($data->with('kelompokMapel')->withCount('pembelajaran'))->addIndexColumn()
                                  ->editColumn('kelompokMapel.name', function($data){
                                    return $data->kelompokMapel->name;})
                                  ->addColumn('aksi', function($data){
                                      return view('pages.mapel._aksi')->with('data', $data);})
                                  ->make(true);
    }

    return view('pages.mapel.index',[
      'mapel' => $data,
      'sekolah' => $sekolah,
      'kelompokMapel' => KelompokMapel::get(),
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
      'name' => 'required|unique:mapels',
      'singkatan' => 'required',
      'sekolah_id' => 'required',
      'kelompok_mapel_id' => 'required|exists:kelompok_mapels,id',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {
      try {
        DB::beginTransaction();
          Mapel::create($request->all());
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
  public function show(Mapel $mapel)
  {
      abort(404);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, Mapel $mapel)
  {
    if ($request->ajax()) {
      return response()->json(['dataEdit' => $mapel]);
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
  public function update(Request $request, Mapel $mapel)
  {
    $validasi = Validator::make($request->all(),[
      'name' => 'required|unique:mapels,name,' . $mapel->id,
      'singkatan' => 'required',
      'sekolah_id' => 'required',
      'kelompok_mapel_id' => 'required|exists:kelompok_mapels,id',
    ]);

    if ($validasi->fails()) {
      return response()->json(['errors' => $validasi->errors()]);
    } else {

      try {
        DB::beginTransaction();
          $mapel->update($request->all());
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
  public function destroy(Mapel $mapel)
  {
    $success = $mapel->name . ' berhasil dihapus!';
    $mapel->delete();
    return response()->json(['success' => $success]);
  }

}
