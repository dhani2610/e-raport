@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">
          <a href="#" class="float-xs-start" onclick="history.back()">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left text-primary" viewBox="0 0 16 16" style="margin-right: 8px">
              <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
            </svg>
          </a>
          Capaian Projek
        </h4>
      </div>
    </div>
  </div>
</div>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <div class="callout callout-warning my-1 bg-light">
              <table class="table table-borderless mb-0 table-sm">
                <tr>
                  <td class="fw-bold">Tema</td>
                  <td style="width: 1px;" class="px-2">:</td>
                  <td>{{ $projek->tema }}</td>
                </tr>
                <tr>
                  <td class="fw-bold">Fase</td>
                  <td style="width: 1px;" class="px-2">:</td>
                  <td>{{ $projek->fase->name }}</td>
                </tr>
                <tr>
                  <td class="fw-bold">Nama Projek</td>
                  <td style="width: 1px;" class="px-2">:</td>
                  <td>{{ $projek->name }}</td>
                </tr>
              </table>
          </div>
            <button class="btn btn-sm float-left btn-primary btn-icon-split create-button mt-2">
              <i class="fa fa-plus"></i>
              Tambah Capaian Projek
            </button>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="myTableShow" class="table table-sm table-hover mb-0"  style="width: 100%">
                <thead>
                  <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                    <th scope="col">No.</th>
                    <th scope="col">Fase</th>
                    <th scope="col">Dimensi</th>
                    <th scope="col">Elemen</th>
                    <th scope="col">Sub Elemen</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</section>

@include('pages.projek.capaianprojek._create')
{{-- @include('pages.projek.capaianprojek._delete') --}}

@endsection

@section('js')
  @include('partials.toast2');
  @include('pages.projek.capaianprojek.script')
@endsection
