@extends('layouts.main')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6">
            <h4 class="m-0 fw-bold">Profil</h4>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    @include('pages.profil._profile')
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-mine">
                                <li class="nav-item"><a class="nav-link {{ Request::is('profil') ? 'active' : '' }}" href="{{ route('profil.index') }}" >Edit
                                        Profil</a></li>
                                <li class="nav-item"><a class="nav-link {{ Request::is('profil/edit-foto') ? 'active' : '' }}" href="{{ route('profil.editfoto') }}" >Edit Foto</a></li>
                                <li class="nav-item"><a class="nav-link {{ Request::is('profil/edit-akun') ? 'active' : '' }}" href="{{ route('profil.editakun') }}" >Edit Akun</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane {{ Request::is('profil') ? 'active' : '' }}" id="profil">
                                    @include('pages.profil.editprofil')
                                </div>
                                <div class="tab-pane {{ Request::is('profil/edit-foto') ? 'active' : '' }}" id="foto">
                                    @yield('editfoto')
                                </div>
                                <div class="tab-pane {{ Request::is('profil/edit-akun') ? 'active' : '' }}" id="akun">
                                    @yield('editakun')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </section>
@endsection

@section('js')

<script>
  function previewImage() {
      const image = document.querySelector('#gambar');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'inline';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(gambar.files[0]);


      oFReader.onload = function(oFREvent) {
          imgPreview.src = oFREvent.target.result;
      }
  }
</script>
@endsection
