<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaEkskulController;
use App\Http\Controllers\AnggotaKelompokController;
use App\Http\Controllers\CapaianAkhirController;
use App\Http\Controllers\CapaianProjekController;
use App\Http\Controllers\CatatanWalasController;
use App\Http\Controllers\CetakRaportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DimensiController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\ElemenController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\Helper\HelperController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\KelompokMapelController;
use App\Http\Controllers\KetidakhadiranController;
use App\Http\Controllers\LegerNilaiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiAkhirController;
use App\Http\Controllers\PembelajaranController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProjekController;
use App\Http\Controllers\ProjekPilihanKelompokController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SubElemenController;
use App\Http\Controllers\TapelController;
use App\Http\Controllers\TujuanPembelajaranController;
use App\Http\Controllers\UserController;
use App\Models\CapaianAkhir;
use App\Models\Mapel;
use App\Models\NilaiAkhir;
use App\Models\Projek;
use App\Models\Sekolah;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth::logout();
// Auth::loginUsingId(2);

Route::get('/', function () {
  return (Auth::check()) ? redirect(route('dashboard.index'))->withInfo('Anda masih dalam sesi') : redirect(route('login'));
})->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'cekLogin'])->name('login')->middleware('guest');

Route::middleware('auth')->group(function(){
  Route::get('/get-main-data', [HelperController::class, 'getMainData'])->name('getmaindata');
  Route::get('/togglemode', [HelperController::class, 'toggleMode'])->name('togglemode');
  Route::get('/{role}/{id}/get-name', [HelperController::class, 'getName']);

  Route::post('/logout', LogoutController::class)->name('logout');

  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
  Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
  Route::resource('/siswa', SiswaController::class);
  Route::resource('/guru', GuruController::class)->middleware('can:admin');
  Route::post('/guru/import', [GuruController::class, 'import'])->name('guru.import');
  Route::resource('/admin', AdminController::class)->middleware('can:admin');

  Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah.index')->middleware('can:admin');
  Route::put('/sekolah/updatedata', [SekolahController::class, 'updateData'])->name('sekolah.updatedata')->middleware('can:admin');
  Route::put('/sekolah/updatelogo', [SekolahController::class, 'updateLogo'])->name('sekolah.updatelogo')->middleware('can:admin');

  Route::resource('/tapel', TapelController::class)->middleware('can:admin');
  Route::get('/kelas/{id}/name', [HelperController::class, 'getKelasName'])->name('get.kelas.name');
  Route::resource('/kelas', KelasController::class)->parameters(['kelas' => 'kelas']);
  Route::resource('/mapel', MapelController::class)->middleware('can:admin');
  Route::resource('/kelompokmapel', KelompokMapelController::class)->middleware('can:admin');
  Route::resource('/pembelajaran', PembelajaranController::class);
  Route::resource('/ketidakhadiran', KetidakhadiranController::class)->middleware('can:walikelas');
  Route::resource('/catatanwalas', CatatanWalasController::class)->middleware('can:walikelas');
  Route::resource('/ekskul', EkskulController::class);

  Route::get('/sekolah/list', [SekolahController::class, 'list'])->name('list-sekolah');
  Route::get('/sekolah/create', [SekolahController::class, 'create'])->name('create-sekolah');
  Route::post('/sekolah/store', [SekolahController::class, 'store'])->name('store-sekolah');
  Route::post('/updatestatus/{id}', [SekolahController::class, 'updatestatus'])->name('updatestatus');
  Route::get('/sekolah/edit/{id}', [SekolahController::class, 'editsekolah'])->name('edit-sekolah');
  Route::get('/sekolah/delete/{id}', [SekolahController::class, 'deleteSekolah'])->name('delete-sekolah');


Route::middleware('can:pembinaekskul')->group(function(){
  Route::get('/anggotaekskul/{ekskul}/show', [AnggotaEkskulController::class, 'show'])->name('anggotaekskul.show');
  Route::get('/anggotaekskul/{ekskul}/create', [AnggotaEkskulController::class, 'create'])->name('anggotaekskul.create');
  Route::post('/anggotaekskul/store'  , [AnggotaEkskulController::class, 'store'])->name('anggotaekskul.store');
  Route::get('/anggotaekskul/{ekskul}/getdelete', [AnggotaEkskulController::class, 'delete'])->name('anggotaekskul.getdelete');
  Route::delete('/anggotaekskul/{anggotaekskul}/delete', [AnggotaEkskulController::class, 'hapus'])->name('anggotaekskul.delete');
  Route::put('/anggotaekskul/{ekskul}/update', [AnggotaEkskulController::class, 'update'])->name('anggotaekskul.update');
});

  Route::delete('/tujuanpembelajaran/delete/{tujuanpembelajaran}', [TujuanPembelajaranController::class, 'delete']);
  Route::resource('/tujuanpembelajaran', TujuanPembelajaranController::class)->middleware('can:gurumapel');
  Route::resource('/nilaiakhir', NilaiAkhirController::class)->middleware('can:gurumapel');
  Route::put('/deskripsicapaian/{pembelajaran}/update', [NilaiAkhirController::class, 'updateDeskripsi'])->name('deskripsicapaian.update');

  Route::middleware('can:admin')->group(function(){
    Route::resource('/dimensi', DimensiController::class);
    Route::resource('/elemen', ElemenController::class)->parameters(['elemen' => 'elemen']);
    Route::resource('/subelemen', SubElemenController::class)->parameters(['subelemen' => 'subelemen']);
    Route::resource('/capaianakhir', CapaianAkhirController::class);
  });

  Route::resource('/projek', ProjekController::class)->middleware('can:admin');
  Route::resource('/capaianprojek', CapaianProjekController::class)->middleware('can:admin');
  Route::resource('/kelompok', KelompokController::class);
  Route::resource('/anggotakelompok', AnggotaKelompokController::class);
  Route::resource('/projekpilihankelompok', ProjekPilihanKelompokController::class);

  Route::get('/projekpilihankelompok/nilai/{projekpilihankelompok}', [ProjekPilihanKelompokController::class, 'showNilai']);
  Route::put('/projekpilihankelompok/nilai/update/{capaianprojek}', [ProjekPilihanKelompokController::class, 'updateNilai']);
  Route::get('/getcapaianakhir/{capaianprojek}', [ProjekPilihanKelompokController::class, 'getCapaianAkhir'])->name('capaianakhir.get');

  Route::get('/projekpilihankelompok/catatan/{projekpilihankelompok}', [ProjekPilihanKelompokController::class, 'showCatatan']);
  Route::put('/projekpilihankelompok/catatan/update/{projekpilihankelompok}', [ProjekPilihanKelompokController::class, 'updateCatatan']);

  Route::prefix(('/profil'))->group(function() {
    Route::get('/', [ProfilController::class, 'index'])->name('profil.index');
    Route::get('/edit-foto', [ProfilController::class, 'editFoto'])->name('profil.editfoto');
    Route::get('/edit-akun', [ProfilController::class, 'editAkun'])->name('profil.editakun');
    Route::put('/updateprofil/{id}', [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/updatefoto/{id}', [ProfilController::class, 'updatePhoto'])->name('foto.update');
    Route::put('/updateakun/{id}', [ProfilController::class, 'updateAkun'])->name('akunsaya.update');
  });

  Route::resource('/leger', LegerNilaiController::class);

  Route::resource('/cetakrapor', CetakRaportController::class);
  Route::get('/cetakrapor/kelengkapan/{siswa}/{paper}', [CetakRaportController::class, 'kelengkapan'])->name('cetakraport.kelengkapan');
  Route::get('/cetakrapor/semester/{siswa}/{paper}', [CetakRaportController::class, 'semester'])->name('cetakraport.semester');
  Route::get('/cetakrapor/p5/{siswa}/{paper}', [CetakRaportController::class, 'p5'])->name('cetakraport.p5');

});
