<?php

namespace App\Http\Controllers;

use App\Imports\GuruImport;
use App\Models\Guru;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      if (Auth::user()->sekolah_id == 0) {
        $data = Guru::orderBy('name', 'asc');
      }else{
        $data = Guru::where('sekolah_id',Auth::user()->sekolah_id)->orderBy('name', 'asc');
      }

      if ($request->ajax()) {
        return DataTables::of($data->with('user:id,is_aktif'))->addIndexColumn()
                                    ->editColumn('user.is_aktif', function($data){
                                      return $data->user->is_aktif == true ? 'AKTIF' : 'NON-AKTIF';})
                                    ->addColumn('aksi', function($data){
                                        return view('pages.guru._aksi')->with('data', $data);})
                                    ->make(true);
      }

      return view('pages.guru.index',[
        'guru' => $data
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
        return view('pages.guru.create',$data);
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
          'sekolah_id' => 'nullable',
          'email' => 'nullable|unique:users',
          'username' => 'required|unique:users',
          'password' => 'required',
        ]);

        try {
          DB::beginTransaction();
          $user = User::create([
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email,
            'sekolah_id' => $request->sekolah_id,
            'role' => 'guru',
          ]);

          $request['user_id'] = $user->id;
          Guru::create($request->except('username', 'password', 'email'));

          DB::commit();
          return redirect(route('guru.index'))->withSuccess('Data berhasil ditambahkan!');

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
    public function show(Guru $guru)
    {
        $guru->load('user:id,is_aktif,foto');
        return response()->json(['result' => $guru]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        $sekolah = Sekolah::where('status',1)->get();
        $guru->load('user');
        return view('pages.guru.edit', compact('guru','sekolah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guru $guru)
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
        'sekolah_id' => 'nullable',

        'email' => 'nullable|unique:users,email,' . $guru->user_id,
        'username' => 'required|unique:users,username,' . $guru->user_id,
        'is_aktif' => 'required',
      ]);

      try {
        DB::beginTransaction();
        if (filled($request->password)) {
          $guru->user->update([
            'username' => $request->username,
            'email' => $request->email,
            'is_aktif' => $request->is_aktif,
            'sekolah_id' => $request->sekolah_id,
            'password' => $request->password,
          ]);
        } else {
          $guru->user->update([
            'username' => $request->username,
            'email' => $request->email,
            'sekolah_id' => $request->sekolah_id,
            'is_aktif' => $request->is_aktif,
          ]);
        }

        $guru->update($request->except('username', 'password', 'email', 'is_aktif'));
        DB::commit();

        return redirect(route('guru.index'))->withSuccess('Data berhasil diperbarui!');

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
    public function destroy(Guru $guru)
    {
      $success = $guru->name . ' berhasil dihapus!';
      $guru->user->delete();
      return response()->json(['success' => $success]);
    }

    public function import(Request $request)
    {
      $request->validate([
        'file' => ['required', 'file', 'distinct']
      ]);

      $file = $request->file('file');
      if ($file->getClientOriginalExtension() != 'xlsx') {
          return back()->withFailed('Import Gagal! File yang anda masukkan tidak sesuai ketentuan!');
      }

      try {
        Excel::import(new GuruImport, request()->file('file'));
        return redirect()->back()->with('success', 'Data Guru berhasil diimport!');
      } catch (\Throwable $th) {
        return back()->withFailed('Import Gagal! cek kembali ketentuan import!');
      }

    }
}
