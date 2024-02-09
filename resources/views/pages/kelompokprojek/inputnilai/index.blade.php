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
          Kelola Nilai Projek
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
              <table class="table table-sm table-borderless mb-0 table-sm">
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
                <tr>
                  <td class="fw-bold">Persentase Data Diisi</td>
                  <td style="width: 1px;" class="px-2">:</td>
                  <td>{{ $persentase }}% </td>
                </tr>
                <tr>
                  <td class="fw-bold">Capaian Profil</td>
                  <td style="width: 1px;" class="px-2">:</td>
                </tr>
                <tr>
                  <td colspan="3">
                    <select name="capaian-projek-select" class="form form-control selectTwo" id="capaian-projek-select">
                      @foreach ($capaianakhir as $item)
                        <option value="{{ $item->id }}" selected>{{ $item->capaianAkhir->subElemen->name }}</option>
                      @endforeach
                    </select>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <form action="#" id="form-update-predikat" method="POST">
          @csrf
          @method('PUT')
            <div class="card-body" id="card-body">
              <div class="">
                <button type="button" class="btn btn-warning btn-sm float-left d-none" id="detail-capaianprofil-button">
                  <i class="fas fa-eye"></i>
                  Capaian Profil
                </button>
                <button type="button" class="btn btn-info btn-sm float-right" id="terapkan-predikat-rata-button">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 1.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1Zm-5 0A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5v-1Zm-2 0h1v1A2.5 2.5 0 0 0 6.5 5h3A2.5 2.5 0 0 0 12 2.5v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2Z"/>
                  </svg>
                  Terapkan Predikat Rata
                </button>
              </div>
              <div class="table-responsive">
                <div class="mb-2"></div>
                <table id="myTableShow" class="table table-sm table-hover mb-0"  style="width: 100%">
                  <thead>
                    <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                      <th scope="col">No.</th>
                      <th scope="col">NIS</th>
                      <th scope="col">Nama</th>
                      <th scope="col">L/P</th>
                      <th scope="col" style="min-width: 200px">Predikat</th>
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

{{-- @include('pages.kelompokprojek.inputnilai._create') --}}
@include('pages.kelompokprojek.inputnilai._predikatrata')
@include('pages.kelompokprojek.inputnilai._capaianprofil')

@endsection

@section('js')
  @include('partials.toast2');
  @include('pages.kelompokprojek.inputnilai.script')
@endsection
