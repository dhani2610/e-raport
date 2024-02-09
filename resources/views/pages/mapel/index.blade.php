@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">Data Mata Pelajaran</h4>
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
            <button class="btn btn-sm float-left btn-primary btn-icon-split create-button">
              <i class="fa fa-plus"></i>
              Tambah <span class="d-xs-none">Mapel</span>
            </button>
            <div class="float-right">
              <button class="btn btn-sm btn-info btn-icon-split" data-toggle="modal" data-target="#modal-filter">
                <i class="fa fa-filter me-2"></i>
                Filter <span class="d-xs-none">Data</span>
              </button>
              <a href="{{ route('kelompokmapel.index') }}" class="btn btn-sm btn-warning btn-icon-split loadAMoment">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                  <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                </svg>
                Kelompok <span class="d-xs-none">Mapel</span>
              </a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <div class="table-responsive">
                <table id="myTable" class="table table-sm table-hover mb-0">
                  <thead>
                  <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                    <th scope="col">No.</th>
                    <th scope="col" class="mw-100">Nama Mapel</th>
                    <th scope="col">Singkatan</th>
                    <th scope="col" class="mw-100">Kelompok</th>
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

@include('pages.mapel._createform')
@include('pages.mapel._editform')
{{-- @include('pages.mapel._show') --}}
@include('pages.mapel._delete')
@include('pages.mapel._filter')

@endsection

@section('js')
 @include('pages.mapel.script')
@endsection
