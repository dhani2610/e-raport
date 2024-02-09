@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">Data Kelompok Projek</h4>
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
                Tambah Kelompok Projek
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
                <table id="myTable" class="table table-sm table-hover mb-0" style="width: 100%">
                  <thead>
                    <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                      <th scope="col">No.</th>
                      <th scope="col">Nama Kelompok Projek</th>
                      <th scope="col">Kelas</th>
                      <th scope="col">Koordinator</th>
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

@include('pages.kelompokprojek.main._filter')
@include('pages.kelompokprojek.main._create')
@include('pages.kelompokprojek.main._edit')
@include('pages.kelompokprojek.main._delete')

@endsection

@section('js')
  @include('partials.toast2');
  @include('pages.kelompokprojek.main.script')
@endsection
