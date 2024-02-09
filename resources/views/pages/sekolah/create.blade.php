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
<form action="{{ route('store-sekolah') }}" method="post" enctype="multipart/form-data"> 
  @csrf
<section class="content">
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Tambah Data Sekolah</div>
          </div>
          <div class="card-body">
              @include('pages.sekolah._createdata')
          </div>
          <div class="card-footer justify-content-between">
            <div class="checkbox d-inline">
              <label> <input type="checkbox" id="update-data-confirm" required> Saya yakin akan simpan data tersebut </label>
            </div>
            <button type="submit" class="btn btn-primary float-right" >Simpan</button>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Logo Sekolah</div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-border table-hover mt-xs-2">
                  <tr class="text-center table-secondary">
                    <td>Logo</td>
                  </tr>
                  <tr>
                    <td class="text-center"><img src="/img/" alt="" style="width: 120px" class="img-preview"></td>
                  </tr>
              </table>
            </div>
            
            <small class="fs-12"> <i>logo sekolah</i></small>
                <div class="">
                  <div class="input-group mb-3">
                    <input type="file" accept="image/*" class="form-control logo-field" name="logo" id="gambar" onchange="previewImage()">
                    <span class="invalid-feedback mt-1" id="error-logo"></span>
                  </div>
                </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <div class="card-title">Status Sekolah</div>
          </div>
          <div class="card-body">
                <div class="">
                  <div class="input-group mb-3">
                    <select name="status" id="" class="form-control">
                      <option value="1">Aktif</option>
                      <option value="2">Tidak Aktif</option>
                    </select>
                  </div>
                </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
</form>
@endsection

@section('js')
 @include('pages.sekolah.script');
 @include('partials.toast2');
@endsection
