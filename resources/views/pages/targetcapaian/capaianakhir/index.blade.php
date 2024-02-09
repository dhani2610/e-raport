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
          Data Capaian Akhir
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
                    <td class="fw-bold">Dimensi</td>
                    <td style="width: 1px;" class="px-2">:</td>
                    <td>{{ $subelemen->elemen->dimensi->name }}</td>
                  </tr>
                  <tr>
                    <td class="fw-bold">Elemen</td>
                    <td style="width: 1px;" class="px-2">:</td>
                    <td>{{ $subelemen->elemen->name }}</td>
                  </tr>
                  <tr>
                    <td class="fw-bold">Sub Elemen</td>
                    <td style="width: 1px;" class="px-2">:</td>
                    <td>{{ $subelemen->name }}</td>
                  </tr>
                </table>
            </div>
            <button class="btn btn-sm float-left btn-primary btn-icon-split create-button mt-3">
              <i class="fa fa-plus"></i>
              Tambah Capaian Akhir
            </button>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="myTable" class="table table-sm table-hover mb-0">
                <thead>
                <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                  <th scope="col">No.</th>
                  <th scope="col">Fase</th>
                  <th scope="col">Capaian Akhir</th>
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

@include('pages.targetcapaian.capaianakhir._create')
@include('pages.targetcapaian.capaianakhir._edit')
@include('pages.targetcapaian.capaianakhir._delete')

@endsection

@section('js')
  @include('partials.toast2');
 @include('pages.targetcapaian.capaianakhir.script')
@endsection
