<?php

namespace App\Http\Controllers;

use App\Imports\CapaianAkhirImport;
use App\Imports\SiswaImport;
use App\Models\Kelas;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\Tingkat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class SiswaController extends Controller
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
              $data = Siswa::query()->orderBy('name', 'asc');
            } elseif($user->isWaliKelas()){
              $data = Siswa::where('kelas_id', $user->guru->kelas->id)->orderBy('name', 'asc');
            } else {
              abort(403);
            }
        }else{
            if ($user->isAdmin()) {
              $data = Siswa::query()->orderBy('name', 'asc')->where('sekolah_id',Auth::user()->sekolah_id);
            } elseif($user->isWaliKelas()){
              $data = Siswa::where('kelas_id', $user->guru->kelas->id)->where('sekolah_id',Auth::user()->sekolah_id)->orderBy('name', 'asc');
            } else {
              abort(403);
            }
        }
      

        if ($request->ajax()) {

          if ($request->jk) $data->where('jk', $request->jk);
          if ($request->kelas_id) $data->where('kelas_id', $request->kelas_id);
          if ($request->is_aktif !== null) {
            $isAktif = $request->is_aktif === '1' ? true : false;
            $data->whereHas('user', fn($q) => $q->where('is_aktif', $isAktif));
          }

          return DataTables::of($data->with('user:id,is_aktif', 'kelas'))->addIndexColumn()
                                      ->editColumn('kelas.name', function($data){
                                        return ($data->kelas) ? $data->kelas->name : '-';
                                      })
                                      ->editColumn('user.is_aktif', function($data){
                                        return $data->user->is_aktif == true ? 'AKTIF' : 'NON-AKTIF';
                                      })
                                      ->editColumn('nis-nisn', function($data){
                                        return $data->nis . '/' . $data->nisn;
                                      })
                                      ->addColumn('aksi', function($data){
                                        return view('pages.siswa._aksi')->with('data', $data);
                                      })
                                      ->make(true);
          }

        return view('pages.siswa.index', [
          'siswa' => $data,
          'kelas' => Kelas::select('id', 'name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isWaliKelas()) abort(403);

        if (Auth::user()->sekolah_id == 0) {
          $kelas = Kelas::select('id','name')->get();
        }else{
          $kelas = Kelas::where('sekolah_id',Auth::user()->sekolah_id)->select('id','name')->get();
        }
        return view('pages.siswa.create',[
          'sekolah' => Sekolah::where('status',1)->get(),
          'kelas' => $kelas,
          'tingkat' => Tingkat::select('angka', 'romawi')->get()
        ]);
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
          'kelas_id' => 'nullable',
          'name' => 'required',
          'nis' => 'nullable|numeric|unique:siswas,nis',
          'nisn' => 'nullable|numeric|unique:siswas,nisn',
          'tempatlahir' => 'required',
          'tanggallahir' => 'required|date',
          'jk' => 'required',
          'agama' => 'required',
          'statusdalamkeluarga' => 'nullable',
          'anak_ke' => 'nullable|numeric',
          'alamatsiswa' => 'nullable',
          'teleponsiswa' => 'nullable',
          'sekolahasal' => 'nullable',
          'diterimadikelas' => 'nullable',
          'diterimaditanggal' => 'nullable|date',
          'namaayah' => 'nullable',
          'pekerjaanayah' => 'nullable',
          'namaibu' => 'nullable',
          'pekerjaanibu' => 'nullable',
          'alamatortu' => 'nullable',
          'teleponortu' => 'nullable',
          'namawali' => 'nullable',
          'pekerjaanwali' => 'nullable',
          'alamatwali' => 'nullable',
          'teleponwali' => 'nullable',
          'sekolah_id' => 'required',
          'email' => 'nullable',
          'username' => 'required|unique:users',
          'password' => 'required',

        ]);

        $user = User::create([
          'username' => $request->username,
          'password' => $request->password,
          'email' => $request->email,
          'sekolah_id' => $request->sekolah_id,
          'role' => 'siswa',
        ]);

        $request['user_id'] = $user->id;
        Siswa::create($request->except('username', 'password', 'email'));
        return redirect(route('siswa.index'))->withSuccess('Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        $siswa->load('user:id,is_aktif,foto');
        $siswa->has('kelas') ? $siswa->load('kelas:id,name') : '';
        return response()->json(['result' => $siswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
      if (!Auth::user()->isAdmin() && !Auth::user()->isWaliKelas()) abort(403);

      if (Auth::user()->sekolah_id == 0) {
        $kelas = Kelas::select('id','name')->get();
      }else{
        $kelas = Kelas::where('sekolah_id',Auth::user()->sekolah_id)->select('id','name')->get();
      }
        return view('pages.siswa.edit',[
          'siswa' => $siswa,
          'sekolah' => Sekolah::where('status',1)->get(),
          'kelas' => $kelas,
          'tingkat' => Tingkat::select('angka', 'romawi')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
      $request->validate([
        'kelas_id' => 'nullable',
        'name' => 'required',
        'nis' => 'nullable|numeric|unique:siswas,nis,' . $siswa->id,
        'nisn' => 'nullable|numeric|unique:siswas,nisn,' . $siswa->id,
        'tempatlahir' => 'required',
        'tanggallahir' => 'required|date',
        'jk' => 'required',
        'agama' => 'required',
        'statusdalamkeluarga' => 'nullable',
        'anak_ke' => 'nullable|numeric',
        'alamatsiswa' => 'nullable',
        'teleponsiswa' => 'nullable',
        'sekolahasal' => 'nullable',
        'diterimadikelas' => 'nullable',
        'diterimaditanggal' => 'nullable|date',
        'namaayah' => 'nullable',
        'pekerjaanayah' => 'nullable',
        'namaibu' => 'nullable',
        'pekerjaanibu' => 'nullable',
        'alamatortu' => 'nullable',
        'teleponortu' => 'nullable',
        'namawali' => 'nullable',
        'pekerjaanwali' => 'nullable',
        'alamatwali' => 'nullable',
        'teleponwali' => 'nullable',
        'sekolah_id' => 'required',
        'email' => 'nullable|unique:users,email,' . $siswa->user_id,
        'username' => 'required|unique:users,username,' . $siswa->user_id,
        'is_aktif' => 'required',
        'password' => 'nullable',

      ]);

      if (filled($request->password)) {
        $siswa->user->update([
          'username' => $request->username,
          'email' => $request->email,
          'is_aktif' => $request->is_aktif,
          'sekolah_id' => $request->sekolah_id,
          'password' => $request->password,
        ]);
      } else {
        $siswa->user->update([
          'username' => $request->username,
          'email' => $request->email,
          'is_aktif' => $request->is_aktif,
          'sekolah_id' => $request->sekolah_id,
        ]);
      }

      $siswa->update($request->except('username', 'password', 'email', 'is_aktif'));
      return redirect(route('siswa.index'))->withSuccess('Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
      $success = $siswa->name . ' berhasil dihapus!';
      $siswa->user->delete();
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
        Excel::import(new SiswaImport, request()->file('file'));
        return redirect()->back()->with('success', 'Data siswa berhasil diimport!');
      } catch (\Throwable $th) {
        return back()->withFailed('Import Gagal! cek kembali ketentuan import!');
      }

    }
}
