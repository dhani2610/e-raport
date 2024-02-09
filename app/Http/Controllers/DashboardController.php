<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Ekskul;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelompokProjek;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use App\Models\Projek;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

      $data = [];

      $user = Auth::user();
      if (Auth::user()->sekolah_id == 0) {
        if ($user->isAdmin()) $data = array_merge($data, $this->dataAdmin());
        if ($user->isWaliKelas()) $data = array_merge($data, $this->dataWaliKelas());
        if ($user->isGuruMapel()) $data = array_merge($data, $this->dataGuruMapel());
        if ($user->isPembinaEkskul()) $data = array_merge($data, $this->dataPembinaEkskul());
        if ($user->isKoordinatorP5()) $data = array_merge($data, $this->dataKoordinatorP5());
        if ($user->isSiswa()) $data = array_merge($data, $this->dataSiswa());
      }else{
        if ($user->isAdmin()) $data = array_merge($data, $this->dataAdminBySekolahid());
        if ($user->isWaliKelas()) $data = array_merge($data, $this->dataWaliKelasBySekolahid());
        if ($user->isGuruMapel()) $data = array_merge($data, $this->dataGuruMapelBySekolahid());
        if ($user->isPembinaEkskul()) $data = array_merge($data, $this->dataPembinaEkskulBySekolahid());
        if ($user->isKoordinatorP5()) $data = array_merge($data, $this->dataKoordinatorP5());
        if ($user->isSiswa()) $data = array_merge($data, $this->dataSiswaBySekolahid());

      }

      return view('pages.dashboard.index', compact('data'));
    }

    private function dataAdmin(){
      return [
        [
          'title' => 'Data Siswa',
          'count' => Siswa::count(),
          'colour' => 'bg-primary',
          'route' => 'siswa.index',
        ],
        [
          'title' => 'Data Guru',
          'count' => Guru::count(),
          'colour' => 'bg-danger',
          'route' => 'guru.index',
        ],
        [
          'title' => 'Data Admin',
          'count' => Admin::count(),
          'colour' => 'bg-warning',
          'route' => 'admin.index',
        ],
        [
          'title' => 'Data Kelas',
          'count' => Kelas::count(),
          'colour' => 'bg-success',
          'route' => 'kelas.index',
        ],
        [
          'title' => 'Data Mapel',
          'count' => Mapel::count(),
          'colour' => 'bg-danger',
          'route' => 'mapel.index',
        ],
        [
          'title' => 'Data Pembelajaran',
          'count' => Pembelajaran::count(),
          'colour' => 'bg-success',
          'route' => 'pembelajaran.index',
        ],
        [
          'title' => 'Data Ekstrakurikuler',
          'count' => Ekskul::count(),
          'colour' => 'bg-primary',
          'route' => 'ekskul.index',
        ],
        [
          'title' => 'Data Projek',
          'count' => Projek::count(),
          'colour' => 'bg-warning',
          'route' => 'projek.index',
        ],
      ];
    }

    private function dataWaliKelas(){
      return [
        [
          'title' => 'Data Siswa',
          'count' => Siswa::where('kelas_id', Auth::user()->guru->kelas->id)->count(),
          'colour' => 'bg-primary',
          'route' => 'siswa.index',
        ],
        [
          'title' => 'Cetak Rapor',
          'count' => null,
          'colour' => 'bg-success',
          'route' => 'cetakrapor.index',
        ],
      ];
    }

    private function dataGuruMapel(){
      return [
        [
          'title' => 'Data Pembelajaran',
          'count' => Pembelajaran::where('guru_id', Auth::user()->guru->id)->count(),
          'colour' => 'bg-success',
          'route' => 'pembelajaran.index',
        ],
      ];
    }

    private function dataPembinaEkskul(){
      return [
        [
          'title' => 'Data Ekstrakurikuler',
          'count' => Ekskul::where('guru_id', Auth::user()->guru->id)->count(),
          'colour' => 'bg-warning',
          'route' => 'ekskul.index',
        ],
      ];
    }

    private function dataKoordinatorP5(){
      return [
        [
          'title' => 'Data Kelompok Projek',
          'count' => KelompokProjek::where('guru_id', Auth::user()->guru->id)->count(),
          'colour' => 'bg-warning',
          'route' => 'kelompok.index',
        ],
      ];
    }

    private function dataSiswa(){
      return [
        [
          'title' => 'Cetak Rapor',
          'count' => null,
          'colour' => 'bg-success',
          'route' => 'cetakrapor.index',
        ],
      ];
    }

    // by sekolah 
    private function dataAdminBySekolahID(){
      return [
        [
          'title' => 'Data Siswa',
          'count' => Siswa::where('sekolah_id',Auth::user()->sekolah_id)->count(),
          'colour' => 'bg-primary',
          'route' => 'siswa.index',
        ],
        [
          'title' => 'Data Guru',
          'count' => Guru::where('sekolah_id',Auth::user()->sekolah_id)->count(),
          'colour' => 'bg-danger',
          'route' => 'guru.index',
        ],
        [
          'title' => 'Data Admin',
          'count' => Admin::where('sekolah_id',Auth::user()->sekolah_id)->count(),
          'colour' => 'bg-warning',
          'route' => 'admin.index',
        ],
        [
          'title' => 'Data Kelas',
          'count' => Kelas::where('sekolah_id',Auth::user()->sekolah_id)->count(),
          'colour' => 'bg-success',
          'route' => 'kelas.index',
        ],
        [
          'title' => 'Data Mapel',
          'count' => Mapel::where('sekolah_id',Auth::user()->sekolah_id)->count(),
          'colour' => 'bg-danger',
          'route' => 'mapel.index',
        ],
        [
          'title' => 'Data Pembelajaran',
          'count' => Pembelajaran::where('sekolah_id',Auth::user()->sekolah_id)->count(),
          'colour' => 'bg-success',
          'route' => 'pembelajaran.index',
        ],
        [
          'title' => 'Data Ekstrakurikuler',
          'count' => Ekskul::where('sekolah_id',Auth::user()->sekolah_id)->count(),
          'colour' => 'bg-primary',
          'route' => 'ekskul.index',
        ],
        [
          'title' => 'Data Projek',
          'count' => Projek::where('sekolah_id',Auth::user()->sekolah_id)->count(),
          'colour' => 'bg-warning',
          'route' => 'projek.index',
        ],
      ];
    }
    private function dataWaliKelasBySekolahID(){
      return [
        [
          'title' => 'Data Siswa',
          'count' => Siswa::where('sekolah_id',Auth::user()->sekolah_id)->where('kelas_id', Auth::user()->guru->kelas->id)->count(),
          'colour' => 'bg-primary',
          'route' => 'siswa.index',
        ],
        [
          'title' => 'Cetak Rapor',
          'count' => null,
          'colour' => 'bg-success',
          'route' => 'cetakrapor.index',
        ],
      ];
    }

    private function dataGuruMapelBySekolahID(){
      return [
        [
          'title' => 'Data Pembelajaran',
          'count' => Pembelajaran::where('sekolah_id',Auth::user()->sekolah_id)->where('guru_id', Auth::user()->guru->id)->count(),
          'colour' => 'bg-success',
          'route' => 'pembelajaran.index',
        ],
      ];
    }

    private function dataPembinaEkskulBySekolahID(){
      return [
        [
          'title' => 'Data Ekstrakurikuler',
          'count' => Ekskul::where('sekolah_id',Auth::user()->sekolah_id)->where('guru_id', Auth::user()->guru->id)->count(),
          'colour' => 'bg-warning',
          'route' => 'ekskul.index',
        ],
      ];
    }
    
    private function dataSiswaBySekolahID(){
      return [
        [
          'title' => 'Cetak Rapor',
          'count' => null,
          'colour' => 'bg-success',
          'route' => 'cetakrapor.index',
        ],
      ];
    }

}
