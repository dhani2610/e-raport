<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class PembelajaranController extends Controller
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
      $data = Pembelajaran::orderBy('mapel_id', 'asc')->orderBy('kelas_id', 'asc');
    } elseif($user->isGuruMapel()){
      $data = Pembelajaran::where('guru_id', $user->guru->id)->orderBy('mapel_id', 'asc')->orderBy('kelas_id', 'asc');
    } else {
      abort(403);
    }

    $guru = Guru::orderBy('name', 'asc')->get();
    $kelas = Kelas::get();
    $mapel = Mapel::get();
  } else {
    if ($user->isAdmin()) {
      $data = Pembelajaran::where('sekolah_id',Auth::user()->sekolah_id)->orderBy('mapel_id', 'asc')->orderBy('kelas_id', 'asc');
    } elseif($user->isGuruMapel()){
      $data = Pembelajaran::where('sekolah_id',Auth::user()->sekolah_id)->where('guru_id', $user->guru->id)->orderBy('mapel_id', 'asc')->orderBy('kelas_id', 'asc');
    } else {
      abort(403);
    }

    $guru = Guru::where('sekolah_id',Auth::user()->sekolah_id)->orderBy('name', 'asc')->get();
    $kelas = Kelas::where('sekolah_id',Auth::user()->sekolah_id)->get();
    $mapel = Mapel::where('sekolah_id',Auth::user()->sekolah_id)->get();

  }
  

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
          return view('pages.pembelajaran._aksi')->with('data', $data);})
      ->make(true);
  }

  $sekolah = Sekolah::where('status',1)->get();

  return view('pages.pembelajaran.index',[
    'sekolah' => $sekolah,
    'pembelajaran' => $data,
    'kelas' => $kelas,
    'mapel' => $mapel,
    'guru' => $guru,
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
    'kelas_id' => 'required|exists:kelas,id',
    'mapel_id' => [
      'required',
      'exists:mapels,id',
      function ($attribute, $value, $fail) use ($request) {
          $isDuplicate = Pembelajaran::where('kelas_id', $request->kelas_id)->where('mapel_id', $request->mapel_id)->exists();
          if ($isDuplicate) $fail('Pembelajaran pada kelas yang dipilih sudah ada');
      },
    ],
    'guru_id' => 'nullable|exists:gurus,id',
  ]);

  if ($validasi->fails()) {
    return response()->json(['errors' => $validasi->errors()]);
  } else {
    try {
      DB::beginTransaction();
        Pembelajaran::create($request->all());
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
public function show(Pembelajaran $pembelajaran)
{
    abort(404);
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function edit(Request $request, Pembelajaran $pembelajaran)
{
  if ($request->ajax()) {
    return response()->json(['dataEdit' => $pembelajaran]);
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
public function update(Request $request, Pembelajaran $pembelajaran)
{
  $validasi = Validator::make($request->all(),[
    'kelas_id' => 'required|exists:kelas,id',
    'mapel_id' => [
      'required',
      'exists:mapels,id',
      function ($attribute, $value, $fail) use ($request, $pembelajaran) {
          if ($request->kelas_id == $pembelajaran->kelas_id && $request->mapel_id == $pembelajaran->mapel_id) {
              return; // Pengecualian, tidak perlu melakukan validasi
          }
          $isDuplicate = Pembelajaran::where('kelas_id', $request->kelas_id)->where('mapel_id', $request->mapel_id)->exists();
          if ($isDuplicate) $fail('Pembelajaran pada kelas yang dipilih sudah ada');
      },
    ],
    'guru_id' => 'nullable|exists:gurus,id',
  ]);

  if ($validasi->fails()) {
    return response()->json(['errors' => $validasi->errors()]);
  } else {

    try {
      DB::beginTransaction();
        $pembelajaran->update($request->all());
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
public function destroy(Pembelajaran $pembelajaran)
{
  $success = 'Pembelajaran: ' . $pembelajaran->mapel->name . ' - ' . $pembelajaran->kelas->name . ' berhasil dihapus!';
  $pembelajaran->delete();
  return response()->json(['success' => $success]);
}

}
