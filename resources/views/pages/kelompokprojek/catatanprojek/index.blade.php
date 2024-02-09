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
          Catatan Projek
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
            <div class="callout callout-warning my-1 bg-light table-responsive">
              <table class="table table-borderless mb-0 table-sm">
                <tr>
                  <td class="fw-bold">Nama Kelompok</td>
                  <td style="width: 1px;" class="px-2">:</td>
                  <td>{{ $projekpilihankelompok->kelompokProjek->name }}</td>
                </tr>
                <tr>
                  <td class="fw-bold">Kelas</td>
                  <td style="width: 1px;" class="px-2">:</td>
                  <td>{{ $projekpilihankelompok->kelompokProjek->kelas->name }}</td>
                </tr>
                <tr>
                  <td class="fw-bold">Guru/Koordinator</td>
                  <td style="width: 1px;" class="px-2">:</td>
                  <td>{{ $projekpilihankelompok->kelompokProjek->guru->name }}</td>
                </tr>
                <tr>
                  <td class="fw-bold">Nama Projek</td>
                  <td style="width: 1px;" class="px-2">:</td>
                  <td>{{ $projekpilihankelompok->projek->name }}</td>
                </tr>
              </table>
            </div>
          </div>
          <form action="#" id="form-update-catatan" method="POST">
          @csrf
          @method('PUT')
            <div class="card-body" id="card-body">
              <div class="table-responsive">
                <div class="mb-2"></div>
                <table id="myTableShow" class="table table-sm table-hover mb-0"  style="width: 100%">
                  <thead>
                    <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                      <th scope="col">No.</th>
                      <th scope="col">NIS</th>
                      <th scope="col">Nama</th>
                      <th scope="col">L/P</th>
                      <th scope="col" style="min-width: 300px">Catatan</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <div class="form-check d-inline">
                <input type="checkbox" class="form-check-input" id="update-confirm" required>
                <label class="form-check-label" for="update-confirm">Saya yakin sudah mengisi dengan benar</label>
              </div>
              <button type="submit" class="btn btn-primary float-right d-inline" id="update-button">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('js')
  @include('partials.toast2');
  @include('pages.kelompokprojek.catatanprojek.script')
@endsection
