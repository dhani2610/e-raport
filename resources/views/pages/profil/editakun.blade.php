@extends('pages.profil.index')

@section('editakun')

<form class="form-horizontal" action="{{ route('akunsaya.update', $saya->user_id ) }}" method="post">
  @csrf
  @method('PUT')

      <div class="form-group row">
          <label for="username" class="col-sm-3 col-form-label">Username</label>
          <div class="col-sm-8">
              <input type="text" value="{{ old('username', $saya->user->username) }}" class="form-control @error('username') is-invalid @enderror " name="username" placeholder="Masukkan username">
              @error('username') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
          </div>
      </div>
      <div class="form-group row">
          <label for="password" class="col-sm-3 col-form-label">Password Baru
              <small>(opsional)</small></label>
          <div class="col-sm-8">
              <input type="password" class="form-control @error('password') is-invalid @enderror " name="password" placeholder="Masukkan password baru">
              @error('password') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
          </div>
      </div>
      <div class="offset-sm-3 col-sm-8">
          <div class="checkbox">
              <label>
                <input type="checkbox" required>
                Saya yakin akan mengubah data tersebut
              </label>
          </div>
      </div>
      <div class="offset-sm-3 col-sm-8 mt-2 d-xs-none">
          <button type="submit" class="btn btn-primary btn-md">Simpan</button>
      </div>
      <div class="col text-center mb-0 px-0 d-sm-none">
        <button type="submit" class="btn btn-primary form-control">Simpan</button>
      </div>
  </form>
@endsection
