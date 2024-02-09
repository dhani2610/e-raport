@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">Data Kelas</h4>
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
              Tambah Kelas
            </button>
            <button class="btn btn-sm float-right btn-info btn-icon-split" data-toggle="modal" data-target="#modal-filter">
              <i class="fa fa-filter me-2"></i>
              Filter Data
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
                  <th scope="col">ID Kelas</th>
                  <th scope="col" class="mw-100">Nama Kelas</th>
                  <th scope="col" class="mw-100">Wali Kelas</th>
                  <th scope="col">Tingkat</th>
                  <th scope="col">Jumlah Siswa</th>
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

@include('pages.kelas._createform')
@include('pages.kelas._editform')
{{-- @include('pages.kelas._show') --}}
@include('pages.kelas._delete')
@include('pages.kelas._filter')

@endsection

@section('js')
 @include('pages.kelas.script')
@endsection
