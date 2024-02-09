@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">Data Tujuan Pembelajaran</h4>
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
            <button class="btn btn-sm float-right btn-info btn-icon-split" data-toggle="modal" data-target="#modal-filter">
              <i class="fa fa-filter me-2"></i>
              Filter Data
            </button>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if ($pembelajaran->count() < 1)
              Data masih kosong!
            @else
              <div class="table-responsive">
                <table id="myTable" class="table table-sm table-hover mb-0">
                  <thead>
                  <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                    <th scope="col">No.</th>
                    <th scope="col">Mata Pelajaran</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Guru Pengampu</th>
                    <th scope="col">Aksi</th>
                  </tr>
                  </thead>
                </table>
              </div>
            @endif
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</section>

{{-- @include('pages.pembelajaran._createform') --}}
{{-- @include('pages.pembelajaran._editform') --}}
{{-- @include('pages.pembelajaran._show') --}}
{{-- @include('pages.pembelajaran._delete') --}}
@include('pages.tujuanpembelajaran._filter')

@endsection

@section('js')
 @include('partials.toast2')
 @include('pages.tujuanpembelajaran._scriptindex')
@endsection
