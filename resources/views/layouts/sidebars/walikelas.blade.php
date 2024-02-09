<li class="nav-header fw-bold mt-2">WALI KELAS</li>

<li class="nav-item {{ Request::is('kelas*') |
  Request::is('siswa*') |
  Request::is('ketidakhadiran*') |
  Request::is('catatanwalas*')
  ? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{ Request::is('kelas*') |
      Request::is('siswa*') |
      Request::is('ketidakhadiran*') |
      Request::is('catatanwalas*')
      ? 'active' : '' }}">
        <i class="nav-icon fas fa-columns"></i>
        <p>
          DATA-DATA
          <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('kelas.index') }}" class="nav-link {{ Request::is('kelas*') | Request::is('siswa*') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Data Kelas</p>
            </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('ketidakhadiran.index') }}" class="nav-link {{ Request::is('ketidakhadiran*') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Ketidakhadiran</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('catatanwalas.index') }}" class="nav-link {{ Request::is('catatanwalas*') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Catatan Walas</p>
          </a>
        </li>
    </ul>
</li>


<li class="nav-item {{ Request::is('cetakrapor*') |
  Request::is('leger*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('cetakrapor*') |
      Request::is('leger*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-book"></i>
        <p>
          RAPOR
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
