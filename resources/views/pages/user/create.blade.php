@extends('layouts.main')

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">
          <a href="#" class="float-xs-start" onclick="history.back()">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                class="bi bi-arrow-left text-primary" viewBox="0 0 16 16" style="margin-right: 8px">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
            </svg>
          </a>
          Data User</h4>
      </div>
    </div>
  </div>
</div>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header align-items-center">
            <h3 class="card-title pt-1">Tambah Data User</h3>
            <div class="float-right py-0">
              <button class="btn btn-light btn-sm rounded-pill" data-toggle="popover" data-trigger="focus" title="Informasi" data-placement="left" data-content="* Merupakan kolom yang wajib diisi."><i class="fa fa-info"></i></button>
            </div>
          </div>

          <form class="form-horizontal" action="{{ route('user.store') }}" method="POST">
          @csrf

            <div class="card-body">

              @include('pages.user._createform')

              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="confirm" required>
                    <label class="form-check-label" for="confirm">Saya yakin sudah mengisi dengan benar</label>
                  </div>
                </div>
              </div>

            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="reset" class="btn btn-outline-info float-right">Reset</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>

@endsection
