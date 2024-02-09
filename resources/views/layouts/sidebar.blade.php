<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a class="brand-link">
      <img src="/img/logosekolah.png" alt="E-Raport"
          class="brand-image img-circle elevation-3" style="opacity: .8" style="width: 50px" id="logoSekolah">
      <span class="brand-text font-weight-light d-xs-none text-uppercase">{{ Auth::user()->role }}</span>
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


          @can('gurumapel')
              @include('layouts.sidebars.gurumapel')
          @endcan

          @can('koordinatorp5')
              @include('layouts.sidebars.koordinatorp5')
          @endcan

          @can('pembinaekskul')
              @include('layouts.sidebars.pembinaekskul')
          @endcan

          @can('admin')
              @include('layouts.sidebars.admin')
          @endcan

          @can('walikelas')
              @include('layouts.sidebars.walikelas')
          @endcan

          @can('siswa')
              @include('layouts.sidebars.siswa')
          @endcan

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
