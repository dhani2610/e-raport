<nav class="main-header navbar navbar-expand navbar-white navbar-light sen tracking-tight">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

      <li class="nav-item">
          <p class="mb-0 mt-2 fw-bold d-xs-none" id="navTitle">E-RAPORT KURIKULUM MERDEKA</p>
      </li>

      <li class="nav-item">

      </li>
  </ul>

  @if (Auth::user()->status_admin == 1)
    <ul class="navbar-nav ml-auto">
        @php
            $sekolah = App\Models\Sekolah::get(); 
        @endphp
        <select name="sekolah_id" class="form-control selectTwo" id="">
            @foreach ($sekolah as $item)
                <option value="{{$item->id}}">{{ $item->name }}</option>
            @endforeach
        </select>
    </ul>
  @endif
  <ul class="navbar-nav ml-auto">
      <li class="nav-item">
          {{-- <div id="dropdownSubMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="d-xs-none p-2 fw-bold mt-1">{{ $user->name }}</span>
              <span class="d-sm-none p-1 fw-bold mt-1">{{ Str::before($user->name, ' ') }}</span>
              <img src="/img/profile.jpg" style="width: 35px; height: 35px; object-fit: cover;"
                  class="img-circle elevation-1" alt="{{ $user->name }}">
          </div> --}}

          <div id="dropdownSubMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-xs-none p-2 fw-bold mt-1" id="userName"></span>
            <span class="d-sm-none p-1 fw-bold mt-1" id="userNameShort"></span>
            <img src="/img/profile.jpg" style="width: 35px; height: 35px; object-fit: cover;" class="img-circle elevation-1" alt="" id="userImage">
        </div>

          <ul class="dropdown-menu dropdown-menu-right">
              <li>
                  <div class="dropdown-item" onclick="toggleMode()" id="toggle_mode">
                    <input type="hidden" name="toggle_val" id="toggle_value" value="{{ Auth::user()->dark_mode }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-brightness-high" viewBox="0 0 16 16" style="margin-right: 5px">
                      <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                    </svg>
                    Ganti Tema
                  </div>
              </li>
              <li>
                  <hr class="dropdown-divider">
              </li>
              <li>
                  <a href="{{ route('profil.index') }}" class="dropdown-item">Profil</a>
              </li>
              <li>
                  <hr class="dropdown-divider">
              </li>
              <li>
                  <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-logout">Logout</button>
              </li>
          </ul>
      </li>

  </ul>

</nav>

<script>

  function toggleMode(){
    var x = $('#toggle_value').val();

    if (x == '1') {
        $("#main-body").removeClass("dark-mode");
        $(".header-table").addClass("bg-dark");
        $(".header-table").removeClass("bg-light");
        $('#toggle_value').val('0')
    } else {
        $("#main-body").addClass("dark-mode");
        $(".header-table").removeClass("bg-dark");
        $(".header-table").addClass("bg-light");
        $('#toggle_value').val('1')
    }

    $.ajax({
        url: '/togglemode',
        type: 'GET',
        data: {
          mode: $('#toggle_value').val(),
        },
    })
  }
</script>
