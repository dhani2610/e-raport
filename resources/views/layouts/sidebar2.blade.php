<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a class="brand-link">
      <img src="/img/logosekolah.png" alt="E-Raport"
          class="brand-image img-circle elevation-3" style="opacity: .8" style="width: 50px" id="logoSekolah">
      <span class="brand-text font-weight-light d-xs-none text-uppercase">ADMIN</span>
      <span class="brand-text font-weight-light d-sm-none">E-RAPORT
      </span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
          data-accordion="false">

          <li class="nav-item mt-1">
              <a href="{{ '/dashboard' }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                      Dashboard
                  </p>
              </a>
          </li>

          <li class="nav-header fw-bold mt-2">MASTER DATA</li>

          <li class="nav-item {{ Request::is('user*') |
                 Request::is('siswa*') |
                 Request::is('admin*') |
                 Request::is('guru*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::is('user*') |
                     Request::is('siswa*') |
                     Request::is('admin*') |
                     Request::is('guru*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    DATA-DATA
                    <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('siswa.index') }}" class="nav-link {{ Request::is('siswa*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Siswa</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('guru.index') }}" class="nav-link {{ Request::is('guru*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Guru</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.index') }}" class="nav-link {{ Request::is('admin*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Admin</p>
                      </a>
                  </li>
              </ul>
          </li>

          <li class="nav-header fw-bold mt-2">ADMINISTRASI</li>

          <li class="nav-item {{ Request::is('tapel*') |
                 Request::is('sekolah*') |
                 Request::is('kelas*') |
                 Request::is('mapel*') |
                 Request::is('kelompokmapel*') |
                 Request::is('pembelajaran*') |
                 Request::is('ketidakhadiran*') |
                 Request::is('catatanwalas*') |
                 Request::is('ekstrakurikuler*') |
                 Request::is('ekskul*') |
                 Request::is('anggotaekskul*') |
                 Request::is('abc*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::is('tapel*') |
                     Request::is('sekolah*') |
                     Request::is('kelas*') |
                     Request::is('mapel*') |
                     Request::is('kelompokmapel*') |
                     Request::is('pembelajaran*') |
                     Request::is('ketidakhadiran*') |
                     Request::is('catatanwalas*') |
                     Request::is('ekstrakurikuler*') |
                     Request::is('ekskul*') |
                     Request::is('anggotaekskul*') |
                     Request::is('abc*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    DATA-DATA
                    <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('sekolah.index') }}" class="nav-link {{ Request::is('sekolah*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Sekolah</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('tapel.index') }}" class="nav-link {{ Request::is('tapel*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Tapel</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('kelas.index') }}" class="nav-link {{ Request::is('kelas*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Kelas</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('mapel.index') }}" class="nav-link {{ Request::is('mapel*') | Request::is('kelompokmapel*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Mapel</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('pembelajaran.index') }}" class="nav-link {{ Request::is('pembelajaran*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Pembelajaran</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('ketidakhadiran.index') }}" class="nav-link {{ Request::is('ketidakhadiran*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Ketidakhadiran</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('catatanwalas.index') }}" class="nav-link {{ Request::is('catatanwalas*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Catatan Walas</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('ekskul.index') }}" class="nav-link {{ Request::is('ekskul*') | Request::is('anggotaekskul*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Ekstrakurikuler</p>
                      </a>
                  </li>
              </ul>
          </li>

          <li class="nav-header fw-bold mt-2">PEMBELAJARAN</li>

          <li class="nav-item {{ Request::is('user*') |
                 Request::is('tujuanpembelajaran*') |
                 Request::is('nilaiakhir*') |
                 Request::is('deskripsicapaian*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::is('user*') |
                     Request::is('tujuanpembelajaran*') |
                     Request::is('nilaiakhir*') |
                     Request::is('deskripsicapaian*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    DATA-DATA
                    <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('tujuanpembelajaran.index') }}" class="nav-link {{ Request::is('tujuanpembelajaran*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tujuan Pembelajaran</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('nilaiakhir.index') }}" class="nav-link {{ Request::is('nilaiakhir*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Input Nilai Akhir</p>
                      </a>
                  </li>
              </ul>
          </li>

          <li class="nav-header fw-bold mt-2">PROJEK P5</li>

          <li class="nav-item {{ Request::is('dimensi*') |
                 Request::is('elemen*') |
                 Request::is('subelemen*') |
                 Request::is('capaianakhir*') |
                 Request::is('projek*') |
                 Request::is('capaianprojek*') |
                 Request::is('kelompok*') |
                 Request::is('anggotakelompok*') |
                 Request::is('projekpilihankelompok*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::is('dimensi*') |
                     Request::is('elemen*') |
                     Request::is('subelemen*') |
                     Request::is('capaianakhir*') |
                     Request::is('projek*') |
                     Request::is('capaianprojek*') |
                     Request::is('kelompok*') |
                     Request::is('anggotakelompok*') |
                     Request::is('projekpilihankelompok*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    P5
                    <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('dimensi.index') }}" class="nav-link {{ Request::is('dimensi*') | Request::is('elemen*') | Request::is('subelemen*') | Request::is('capaianakhir*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Target Capaian Profil</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('projek.index') }}" class="nav-link {{ Request::is('projek') | Request::is('capaianprojek*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Projek</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('kelompok.index') }}" class="nav-link {{ Request::is('kelompok*') | Request::is('anggotakelompok*') | Request::is('projekpilihankelompok*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelompok Projek</p>
                      </a>
                  </li>
              </ul>
          </li>

          <li class="nav-header fw-bold mt-2">CETAK RAPOR</li>

          <li class="nav-item {{ Request::is('cetakrapor*') |
          Request::is('leger*')
          ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::is('cetakrapor*') |
              Request::is('leger*')
               ? 'active' : '' }}">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    CETAK RAPORT
                    <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('leger.index') }}" class="nav-link {{ Request::is('leger') | Request::is('leger*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Leger Nilai</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('cetakrapor.index') }}" class="nav-link {{ Request::is('cetakrapor') | Request::is('cetakrapor*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cetak Rapor</p>
                      </a>
                  </li>
              </ul>
          </li>

          <li class="nav-header mt-2 fw-bold">SAYA</li>

          <li class="nav-item mb-3">
              <a href="/profil" class="nav-link {{ Request::is('profil*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Profil</p>
              </a>
          </li>

      </ul>
    </nav>
  </div>
</aside>
