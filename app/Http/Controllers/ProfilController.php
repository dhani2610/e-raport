<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProfilController extends Controller
{
  public function index() {
    if (Auth::user()->isAdmin()) {
      $saya = Auth::user()->admin;
    } elseif (Auth::user()->isGuru()){
      $saya = Auth::user()->guru;
    } else {
      $saya = Auth::user()->siswa;
    }

    return view('pages.profil.index', [
      'title' => 'Profil Saya',
      'saya' => $saya
    ]);
  }

  public function editFoto() {
    if (Auth::user()->isAdmin()) {
      $saya = Auth::user()->admin;
    } elseif (Auth::user()->isGuru()){
      $saya = Auth::user()->guru;
    } else {
      $saya = Auth::user()->siswa;
    }
    return view('pages.profil.editfoto', [
      'title' => 'Edit Foto Profil',
      'saya' => $saya
    ]);
  }

  public function editAkun() {
    if (Auth::user()->isAdmin()) {
      $saya = Auth::user()->admin;
    } elseif (Auth::user()->isGuru()){
      $saya = Auth::user()->guru;
    } else {
      $saya = Auth::user()->siswa;
    }
    return view('pages.profil.editakun', [
      'title' => 'Edit Akun',
      'saya' => $saya,
    ]);
  }

  public function update(Request $request, $id) {
    $this->validasiUpdateProfil($request);

    return back()->withSuccess('Profil Anda berhasil diperbarui!');
  }

  public function updatePhoto(Request $request) {
    $request->validate([
      'files' => ['image', 'required'],
    ]);

    $files = $request->file('files');
    if ($request->hasFile('files')) {
      $filenameWithExtension      = $request->file('files')->getClientOriginalExtension();
      $filename                   = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
      $extension                  = $files->getClientOriginalExtension();
      $filenamesimpan             = 'img' . time() . Auth::id(). Str::random(10) . '.' . $extension;
      $files->move('img/fotoprofil/', $filenamesimpan);

      $editdata = [
        'foto' => $filenamesimpan,
      ];

      if (Auth::user()->foto != 'profile.jpg'){
        $filegambar = public_path('/img/fotoprofil/' . Auth::user()->foto );
        File::delete($filegambar);
      }

      Auth::user()->update($editdata);

    }

    return back()->with([
      'success' => 'Foto profil berhasil diperbarui!',
    ]);
  }

  public function updateAkun(Request $request, $id) {
    $akun = User::find($id);

    $request->validate([
      'username' => 'required|unique:users,username,' . $akun->id,
      // 'email' => 'required|unique:users,email,' . $akun->id,
    ]);

    if($request->filled('password')){
      $request['password'] == $request->password;
      $akun->update($request->all());
    } else {
      $akun->update($request->except('password'));
    }
    return back()->withSuccess('Data Akun berhasil diperbarui!');
  }

  private function validasiUpdateProfil($request){
    if (Auth::user()->isAdmin()) {
      $request->validate([
        'name' => 'required',
        'nip' => 'nullable|unique:admins,nip,' . $request->id,
        'nuptk' => 'nullable|unique:admins,nuptk,' . $request->id,
        'jk' => 'required',
        'tempatlahir' => 'nullable',
        'tanggallahir' => 'nullable',
        'telepon' => 'nullable',
        'alamat' => 'nullable',
      ]);

      Auth::user()->admin->update($request->except('email'));
      Auth::user()->update($request->only('email'));

    } elseif (Auth::user()->isGuru()) {
      $request->validate([
        'name' => 'required',
        'nip' => 'nullable|unique:gurus,nip,' . $request->id,
        'nuptk' => 'nullable|unique:gurus,nuptk,' . $request->id,
        'jk' => 'required',
        'tempatlahir' => 'nullable',
        'tanggallahir' => 'nullable',
        'telepon' => 'nullable',
        'alamat' => 'nullable',
      ]);

      Auth::user()->guru->update($request->except('email'));
      Auth::user()->update($request->only('email'));

    } else {
      $request->validate([
        'name' => 'required',
        'nis' => 'nullable|unique:siswas,nis,' . $request->id,
        'nisn' => 'nullable|unique:siswas,nisn,' . $request->id,
        'jk' => 'required',
        'tempatlahir' => 'nullable',
        'tanggallahir' => 'nullable',
        'telepon' => 'nullable',
        'alamatsiswa' => 'nullable',
      ]);

      Auth::user()->siswa->update($request->except('email'));
      Auth::user()->update($request->only('email'));
    }
  }
}
