@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">Data Dimensi</h4>
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
              Tambah Dimensi
            </button>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if ($dimensi->count() < 1)
              Data masih kosong!
            @else
              <div class="table-responsive">
                <table id="myTable" class="table table-sm table-hover mb-0">
                  <thead>
                  <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                    <th scope="col">No.</th>
                    <th scope="col" class="mw-150">Nama Dimensi</th>
                    <th scope="col">Jumlah Elemen</th>
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

@include('pages.targetcapaian.dimensi._create')
@include('pages.targetcapaian.dimensi._edit')
@include('pages.targetcapaian.dimensi._delete')

@endsection

@section('js')
  @include('partials.toast2');
 @include('pages.targetcapaian.dimensi.script')
@endsection
