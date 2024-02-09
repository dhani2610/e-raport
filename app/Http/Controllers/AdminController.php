<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if (Auth::user()->sekolah_id == 0) {
      $data = Admin::orderBy('name', 'asc');
    }else{
      $data = Admin::where('sekolah_id',Auth::user()->sekolah_id)->orderBy('name', 'asc');
    }

    if ($request->ajax()) {
      return DataTables::of($data->with('user:id,is_aktif'))->addIndexColumn()
                                  ->editColumn('user.is_aktif', function($data){
                                    return $data->user->is_aktif == true ? 'AKTIF' : 'NON-AKTIF';})
                                  ->addColumn('aksi', function($data){
                                      return view('pages.admin._aksi')->with('data', $data);})
                                  ->make(true);
    }

    return view('pages.admin.index',[
      'admin' => $data
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $data['sekolah'] = Sekolah::where('status',1)->get();
    return view('pages.admin.create',$data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $request->validate([
        'name' => 'required',
        'nip' => 'nullable',
        'nuptk' => 'nullable',
        'jk' => 'required',
        'tempatlahir' => 'nullable',
        'tanggallahir' => 'nullable',
        'telepon' => 'nullable',
        'alamat' => 'nullable',
        'sekolah_id' => 'required',
        'email' => 'nullable|unique:users',
        'username' => 'required|unique:users',
        'password' => 'required',
      ]);

      try {
        DB::beginTransaction();
        $user = User::create([
          'username' => $request->username,
          'password' => $request->password,
          'sekolah_id' => $request->sekolah_id,
          'email' => $request->email,
          'role' => 'admin',
        ]);

        $request['user_id'] = $user->id;
        Admin::create($request->except('username', 'password', 'email'));

        DB::commit();
        return redirect(route('admin.index'))->withSuccess('Data berhasil ditambahkan!');

      } catch (\Exception $e) {
          DB::rollBack();
          return back()->withInput()->withFailed('Terjadi kesalahan!');
      }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Admin $admin)
  {
      $admin->load('user:id,is_aktif,foto');
      return response()->json(['result' => $admin]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Admin $admin)
  {
      $sekolah = Sekolah::where('status',1)->get();
      $admin->load('user');
      return view('pages.admin.edit', compact('admin','sekolah'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Admin $admin)
  {
    $request->validate([
      'name' => 'required',
      'nip' => 'nullable',
      'nuptk' => 'nullable',
      'jk' => 'required',
      'tempatlahir' => 'nullable',
      'tanggallahir' => 'nullable',
      'telepon' => 'nullable',
      'alamat' => 'nullable',
      'sekolah_id' => 'required',

      'email' => 'nullable|unique:users,email,' . $admin->user_id,
      'username' => 'required|unique:users,username,' . $admin->user_id,
      'is_aktif' => 'required',
    ]);

    try {
      DB::beginTransaction();
      if (filled($request->password)) {
        $admin->user->update([
          'username' => $request->username,
          'email' => $request->email,
          'is_aktif' => $request->is_aktif,
          'password' => $request->password,
          'sekolah_id' => $request->sekolah_id,
        ]);
      } else {
        $admin->user->update([
          'username' => $request->username,
          'email' => $request->email,
          'is_aktif' => $request->is_aktif,
          'sekolah_id' => $request->sekolah_id,
        ]);
      }

      $admin->update($request->except('username', 'password', 'email', 'is_aktif'));
      DB::commit();

      return redirect(route('admin.index'))->withSuccess('Data berhasil diperbarui!');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withInput()->withFailed('Terjadi kesalahan!');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Admin $admin)
  {
    $success = $admin->name . ' berhasil dihapus!';
    $admin->user->delete();
    return response()->json(['success' => $success]);
  }
}
