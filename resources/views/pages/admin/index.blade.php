@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">Data Admin</h4>
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
            <a href="{{ route('admin.create') }}" class="btn btn-sm float-left btn-primary btn-icon-split loadAMoment">
              <i class="fa fa-plus"></i>
              Tambah Admin
            </a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if ($admin->count() < 1)
              Data masih kosong!
            @else
              <div class="table-responsive">
                <table id="myTable" class="table table-sm table-hover mb-0">
                  <thead>
                  <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                    <th scope="col">No.</th>
                    <th scope="col" style="min-width: 150px">Nama</th>
                    <th scope="col">L/P</th>
                    <th scope="col">NIP</th>
                    <th scope="col">NUPTK</th>
                    <th scope="col">Status Admin</th>
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

@include('pages.admin._show')
@include('pages.admin._delete')

@endsection

@section('js')
 @include('pages.admin.script')
@endsection
