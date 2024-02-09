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
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                class="bi bi-arrow-left text-primary" viewBox="0 0 16 16" style="margin-right: 8px">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
            </svg>
            </a>
          Kelola Nilai Akhir
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
        <form action="{{ route('nilaiakhir.update', $pembelajaran->id) }}" method="POST" id="form-update-nilai">
        @csrf
        @method('PUT')
          <div class="card">
            <div class="card-header">
              <div class="callout callout-warning my-1">
                <div class="col-md-6">
                  <table class="table table-sm no-border">
                    <tr>
                      <td class="fw-bold">Mata Pelajaran</td>
                      <td style="width: 1px;" class="px-2">:</td>
                      <td>{{ $pembelajaran->mapel->name }}</td>
                    </tr>
                    <tr>
                      <td class="fw-bold">Kelas</td>
                      <td style="width: 1px;" class="px-2">:</td>
                      <td>{{ $pembelajaran->kelas->name }}</td>
                    </tr>
                    <tr>
                      <td class="fw-bold">Guru Pengampu</td>
                      <td style="width: 1px;" class="px-2">:</td>
                      <td>{{ $pembelajaran->guru_pengampu() }}</td>
                    </tr>
                  </table>
                </div>
              </div>
              @if ($tp->count() >= 1 && $siswa->count() >= 1)
                <div class="mt-3">
                  <button type="button" class="btn btn-warning btn-sm float-left" data-id="{{ $pembelajaran->id }}" id="deskripsi-button">
                    <i class="fas fa-pencil-alt"></i>
                    <span class="d-xs-none">Edit</span> Deskripsi <span class="d-xs-none">Capaian</span>
                  </button>
                  <button type="button" class="btn btn-info btn-sm float-right" id="terapkan-nilai-rata-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-fill" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M10 1.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1Zm-5 0A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5v-1Zm-2 0h1v1A2.5 2.5 0 0 0 6.5 5h3A2.5 2.5 0 0 0 12 2.5v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2Z"/>
                    </svg>
                    Terapkan Nilai Rata
                  </button>
                </div>
              @endif
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if ($tp->count() < 1)
                Tujuan Pembelajaran pada Pembelajaran ini masih kosong! <a href="{{ route('tujuanpembelajaran.show', $pembelajaran->id) }}"><u> Kelola TP </u></a>
              @elseif ($siswa->count() < 1)
                Data Siswa masih kosong!
              @else
                <div class="table-responsive">
                  <table id="myTableShow" class="table table-sm table-hover mb-0">
                    <thead>
                      <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                        <th scope="col" style="width: 20px">No.</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col" style="min-width: 60px">Nilai</th>
                        <th scope="col" class="mw-200">Capaian TP Optimal</th>
                        <th scope="col" class="mw-200">Capaian TP Perlu Peningkatan</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              @endif
            </div>
            @if ($tp->count() >= 1 && $siswa->count() >= 1)
              <div class="card-footer">
                <div class="form-check d-inline">
                  <input type="hidden" name="pembelajaran_id" id="pembelajaran_id" value="{{ $pembelajaran->id }}">
                  <input type="checkbox" class="form-check-input" id="update-confirm" required>
                  <label class="form-check-label" for="update-confirm">Saya yakin sudah mengisi dengan benar</label>
                </div>
                <button type="submit" class="btn btn-primary float-right d-inline" id="update-button">Simpan Perubahan</button>
              </div>
            @endif
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@include('pages.nilaiakhir._inputnilairata')
@endsection

@section('js')
  @include('partials.toast2')
  @include('pages.nilaiakhir._scriptshow')
@endsection
