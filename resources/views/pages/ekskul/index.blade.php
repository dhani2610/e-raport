@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">Data Ekstrakurikuler</h4>
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
          @can('admin')
          <div class="card-header">
            <button class="btn btn-sm float-left btn-primary btn-icon-split create-button">
              <i class="fa fa-plus"></i>
              Tambah Ekstrakurikuler
            </button>
          </div>
          @endcan
          <!-- /.card-header -->
          <div class="card-body">
              <div class="table-responsive">
                <table id="myTable" class="table table-sm table-hover mb-0">
                  <thead>
                  <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                    <th scope="col">No.</th>
                    <th scope="col">Nama Ekstrakurikuler</th>
                    <th scope="col" class="mw-150">Pembina</th>
                    <th scope="col">Jumlah Anggota</th>
                    <th scope="col" class="mw-150">Aksi</th>
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

@include('pages.ekskul._createform')
@include('pages.ekskul._editform')
{{-- @include('pages.ekskul._show') --}}
@include('pages.ekskul._delete')

@endsection

@section('js')
 @include('pages.ekskul.script')
 @include('partials.toast2')
@endsection
