@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">Data Sekolah</h4>
      </div>
    </div>
  </div>
</div>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Edit Data Sekolah</div>
          </div>
          <div class="card-body">
              @include('pages.sekolah._editdata')
          </div>
          <div class="card-footer justify-content-between">
            <div class="checkbox d-inline">
              <label> <input type="checkbox" id="update-data-confirm" required> Saya yakin akan mengubah data tersebut </label>
            </div>
            <button type="submit" class="btn btn-primary float-right" id="update-data-button">Simpan</button>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Edit Logo Sekolah</div>
          </div>
          <div class="card-body">
              @include('pages.sekolah._editlogo')
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <div class="card-title">Status Sekolah</div>
          </div>
          <div class="card-body">
            @include('pages.sekolah._editstatus')
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection

@section('js')
 @include('pages.sekolah.script');
 @include('partials.toast2');
@endsection
