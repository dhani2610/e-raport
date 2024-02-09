<li class="nav-header fw-bold mt-2">MASTER DATA</li>

<li class="nav-item {{ Request::is('user*') |
        Request::is('siswa*') |
        Request::is('admin*') |
        Request::is('guru*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('user*') |
            Request::is('siswa*') |
            Request::is('admin*') |
            Request::is('guru*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>
          PENGGUNA
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
          ADMINISTRASI
          <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        @if (Auth::user()->status_admin == 1)
            <li class="nav-item">
                <a href="{{ route('list-sekolah') }}" class="nav-link {{ Request::is('sekolah*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Daftar Sekolah</p>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a href="{{ route('sekolah.index') }}" class="nav-link {{ Request::is('sekolah*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Sekolah</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('tapel.index') }}" class="nav-link {{ Request::is('tapel*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Tahun Pelajaran</p>
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
            <a href="{{ route('ekskul.index') }}" class="nav-link {{ Request::is('ekskul*') | Request::is('anggotaekskul*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Ekstrakurikuler</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item {{ Request::is('dimensi*') |
        Request::is('elemen*') |
        Request::is('subelemen*') |
        Request::is('capaianakhir*') |
        Request::is('projek*') |
        Request::is('capaianprojek*') |
        Request::is('kelompok') |
        Request::is('anggotakelompok*') |
        Request::is('projekpilihankelompok*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('dimensi*') |
            Request::is('elemen*') |
            Request::is('subelemen*') |
            Request::is('capaianakhir*') |
            Request::is('projek*') |
            Request::is('capaianprojek*') |
            Request::is('kelompok') |
            Request::is('anggotakelompok*') |
            Request::is('projekpilihankelompok*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-table"></i>
        <p>
          PROJEK P5
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
            <a href="{{ route('kelompok.index') }}" class="nav-link {{ Request::is('kelompok') | Request::is('anggotakelompok*') | Request::is('projekpilihankelompok*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Kelompok Projek</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item {{ Request::is('cetakrapor*') |
Request::is('leger*')
? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('cetakrapor*') |
    Request::is('leger*')
      ? 'active' : '' }}">
        <i class="nav-icon fas fa-book"></i>
        <p>
          RAPORT
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
