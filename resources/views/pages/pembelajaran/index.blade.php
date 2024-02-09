@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">Data Pembelajaran</h4>
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
              @can('admin')
              <button class="btn btn-sm float-left btn-primary btn-icon-split create-button">
                <i class="fa fa-plus"></i>
                Tambah Pembelajaran
              </button>
              @endcan
              <button class="btn btn-sm float-right btn-info btn-icon-split" data-toggle="modal" data-target="#modal-filter">
                <i class="fa fa-filter me-2"></i>
                Filter Data
              </button>
            </div>
          <!-- /.card-header -->
          <div class="card-body">
              <div class="table-responsive">
                <table id="myTable" class="table table-sm table-hover mb-0">
                  <thead>
                  <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                    <th scope="col">No.</th>
                    <th scope="col" class="mw-100">Mata Pelajaran</th>
                    <th scope="col">Kelas</th>
                    <th scope="col" class="mw-100">Guru Pengampu</th>
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

@include('pages.pembelajaran._createform')
@include('pages.pembelajaran._editform')
{{-- @include('pages.pembelajaran._show') --}}
@include('pages.pembelajaran._delete')
@include('pages.pembelajaran._filter')

@endsection

@section('js')
 @include('pages.pembelajaran.script')
@endsection
