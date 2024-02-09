@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        @can('admin')
          <h4 class="m-0 fw-bold">Data Siswa</h4>
        @else
        <h4 class="m-0 fw-bold">
          <a href="{{ route('kelas.index') }}" class="float-xs-start" onclick="history.back()">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                class="bi bi-arrow-left text-primary" viewBox="0 0 16 16" style="margin-right: 8px">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
            </svg>
            </a>
          Data Siswa
        </h4>
        @endcan
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
            <a href="{{ route('siswa.create') }}" class="btn btn-sm float-left btn-primary btn-icon-split loadAMoment">
              <i class="fa fa-plus"></i>
              Tambah <span class="d-xs-none">Siswa</span>
            </a>
            <div class="float-right">

              <button class="btn btn-sm btn-info btn-icon-split" data-toggle="modal" data-target="#modal-filter">
                <i class="fa fa-filter me-2"></i>
                Filter <span class="d-xs-none">Data</span>
              </button>
              @can('admin')
                <button class="btn btn-warning btn-sm me-2" data-toggle="modal" data-target="#modal-import">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload me-1" viewBox="0 0 16 16">
                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                    <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                  </svg>
                  Import <span class="d-xs-none">Data</span> Siswa
                </button>
              @endcan
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <div class="table-responsive">
                <table id="myTable" class="table table-sm table-hover mb-0">
                  <thead>
                  <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                    <th scope="col">No.</th>
                    <th scope="col" style="min-width: 150px">Nama</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">NIS/NISN</th>
                    <th scope="col">L/P</th>
                    <th scope="col">Status <span class="d-xs-none">Siswa</span></th>
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

@include('pages.siswa._import')
@include('pages.siswa._filter')
@include('pages.siswa._show')
@include('pages.siswa._delete')

@endsection

@section('js')
 @include('pages.siswa.script')
@endsection
