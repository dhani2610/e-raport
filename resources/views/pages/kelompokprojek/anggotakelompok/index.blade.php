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
          Anggota Kelompok
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
                  <td class="fw-bold">Nama Kelompok</td>
                  <td style="width: 1px;" class="px-2">:</td>
                  <td>{{ $kelompokprojek->name }}</td>
                </tr>
                <tr>
                  <td class="fw-bold">Kelas</td>
                  <td style="width: 1px;" class="px-2">:</td>
                  <td>{{ $kelompokprojek->kelas->name }}</td>
                </tr>
                <tr>
                  <td class="fw-bold">Guru/Koordinator</td>
                  <td style="width: 1px;" class="px-2">:</td>
                  <td>{{ $kelompokprojek->guru->name }}</td>
                </tr>
              </table>
            </div>
            <div class="mt-3">
              <button class="btn btn-sm float-left btn-primary btn-icon-split create-button">
                <i class="fa fa-plus"></i>
                Tambah Anggota <span class="d-xs-none">Kelompok</span>
              </button>
              <a href="/projekpilihankelompok/{{$kelompokprojek->id }}" class="show-projekpilihan-button btn btn-warning btn-sm mx-1 float-right">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                  <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                </svg>
                Projek Pilihan
              </a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="myTableShow" class="table table-sm table-hover mb-0"  style="width: 100%">
                <thead>
                  <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                    <th scope="col">No.</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">L/P</th>
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

@include('pages.kelompokprojek.anggotakelompok._create')

@endsection

@section('js')
  @include('partials.toast2');
  @include('pages.kelompokprojek.anggotakelompok.script')
@endsection
