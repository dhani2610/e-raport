<li class="nav-header fw-bold mt-2">GURU MAPEL</li>

<li class="nav-item">
  <a href="/pembelajaran" class="nav-link {{ Request::is('pembelajaran*') | Request::is('tujuanpembelajaran*') | Request::is('nilaiakhir*') ? 'active' : '' }}">
      <i class="far fa-file nav-icon"></i>
      <p>Data Pembelajaran</p>
  </a>
</li>
