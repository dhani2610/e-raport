<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HelperController extends Controller
{
  public function toggleMode(Request $request){
    $x = ($request->mode == '1') ? true : false;
    Auth::user()->update(['dark_mode' => $x]);
  }

  public function getMainData(){
    if (Auth::user()->guru) {
      $user = Auth::user()->guru;
    } elseif (Auth::user()->admin) {
      $user = Auth::user()->admin;
    } elseif (Auth::user()->siswa) {
      $user = Auth::user()->siswa;
    }

    // $nama_sekolah = Sekolah::count() >= 1 ? Sekolah::first()->name : '';
    // $logo_sekolah = Sekolah::count() >= 1 ? Sekolah::first()->logo : '';

    $data = [
      'name' => $user->name,
      'nameShort' => Str::before($user->name, ' '),
      'image' => '/img/fotoprofil/' . Auth::user()->foto, // Ganti ini sesuai dengan lokasi gambar profil pengguna
      // 'mainTitle' => 'E-RAPORT ' .  $nama_sekolah,
      // 'logoSekolah' => '/img/' . $logo_sekolah,
    ];
    return response()->json($data);
  }

  public function getName($role, $id) {
    if ($role == 'siswa') {
      $data = Siswa::whereId($id)->first()->name;
    } elseif ($role == 'admin') {
      $data = Admin::whereId($id)->first()->name;
    } elseif ($role == 'guru') {
      $data = Guru::whereId($id)->first()->name;
    }
    return response()->json(['name' => $data]);
  }

  public function getKelasName($id) {
    return response()->json(['name' => Kelas::find($id)->name]);
  }
}
