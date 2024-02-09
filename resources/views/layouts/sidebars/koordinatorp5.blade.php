<li class="nav-header fw-bold mt-2">KOORDINATOR P5</li>

<li class="nav-item">
  <a href="/kelompok" class="nav-link {{ Request::is('kelompok') | Request::is('anggotakelompok*') | Request::is('projekpilihankelompok*') ? 'active' : '' }}">
      <i class="fas fa-users nav-icon"></i>
      <p>Data Kelompok Projek</p>
  </a>
</li>
