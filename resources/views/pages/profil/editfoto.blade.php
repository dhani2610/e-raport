@extends('pages.profil.index')

@section('editfoto')

@php
    $user = Auth::user();
@endphp

<div class="row">
  <div class="col-lg-6">
      <div class="table-responsive">
          <table class="table table-borderless mt-xs-2">
            <tr class="text-center text-bold">
              <td>Foto</td>
            </tr>
            <tr>
              <td class="text-center"><img src="/img/fotoprofil/{{ Auth::user()->foto }}" alt="" class="rounded-circle img-profile img-preview" style="width: 120px"></td>
            </tr>
          </table>
      </div>
      <small class="fs-12"> <i>Ganti foto user</i></small>
      <form action="{{ route('foto.update', $saya->user_id ) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

        <div class="">
          <div class="input-group mb-3">
            <input type="hidden" name="user_id" value="">
            <input type="file" accept="image/*" class="form form-control @error('files') is-invalid @enderror" name="files" id="gambar" onchange="previewImage()">
            <button type="submit" class="btn btn-primary" for="inputGroupFile02">Update</button>
            @error('files') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
          </div>
        </div>

      </form>
  </div>
</div>

@endsection
