<form class="form-horizontal" action="{{ route('profil.update', $saya->id ) }}" method="post">
  @csrf
  @method('PUT')

      <div class="form-group row">
          <label for="inputName" class="col-sm-3 col-form-label">Nama @include('partials._wajib')</label>
          <div class="col-sm-9">
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Maukkan nama lengkap" value="{{ old('name', $saya->name) }}" >
              @error('name') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
          </div>
      </div>

      @can('siswa')
        <div class="form-group row">
          <label for="nis" class="col-sm-3 col-form-label">NIS</label>
          <div class="col-sm-9">
              <input type="number" name="nis" class="form-control" id="nis" placeholder="Masukkan NIS" value="{{ old('nis', $saya->nis) }}">
              @error('nis') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
          </div>
        </div>
        <div class="form-group row">
          <label for="nisn" class="col-sm-3 col-form-label">NISN</label>
          <div class="col-sm-9">
              <input type="number" name="nisn" class="form-control" id="nisn" placeholder="Masukkan NISN" value="{{ old('nisn', $saya->nisn) }}">
              @error('nisn') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
          </div>
        </div>
      @else
        <div class="form-group row">
          <label for="nuptk" class="col-sm-3 col-form-label">NUPTK</label>
          <div class="col-sm-9">
              <input type="number" name="nuptk" class="form-control" id="nuptk" placeholder="Masukkan NUPTK" value="{{ old('nuptk', $saya->nuptk) }}">
              @error('nuptk') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
          </div>
        </div>
        <div class="form-group row">
          <label for="nip" class="col-sm-3 col-form-label">NIP</label>
          <div class="col-sm-9">
              <input type="number" name="nip" class="form-control" id="nip" placeholder="Masukkan NIP" value="{{ old('nip', $saya->nip) }}">
              @error('nip') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
          </div>
        </div>
      @endcan

      <div class="form-group row">
          <label for="telepon" class="col-sm-3 col-form-label">Jenis Kelamin @include('partials._wajib')</label>
          <div class="col-sm-9">
            <select name="jk" id="jk" class="form-control selectTwo @error('jk') is-invalid @enderror" data-width="100%" required>
              <option disabled selected hidden>-- Pilih --</option>
              <option value="L" {{ old('jk', $saya->jk) == 'L' ? 'selected' : '' }}>Laki-laki</option>
              <option value="P" {{ old('jk', $saya->jk) == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jk') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
          </div>
      </div>

      <div class="form-group row">
          <label for="telepon" class="col-sm-3 col-form-label">Telepon</label>
          <div class="col-sm-9">
              <input type="number" name="telepon" class="form-control" id="telepon" placeholder="Masukkan telepon" value="{{ old('telepon', $saya->telepon) }}">
              @error('telepon') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
          </div>
      </div>

      <div class="form-group row">
          <label for="email" class="col-sm-3 col-form-label">Email</label>
          <div class="col-sm-9">
            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email" value="{{ old('email', $saya->user->email) }}">
            @error('email') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
          </div>
      </div>

      @can('siswa')
        <div class="form-group row">
          <label for="inputName" class="col-sm-3 col-form-label">Alamat</label>
          <div class="col-sm-9">
            <textarea name="alamatsiswa" id="" rows="3" class="form-control" placeholder="Alamat">{{ old('alamatsiswa', $saya->alamatsiswa) }}</textarea>
            @error('alamatsiswa') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
          </div>
        </div>
      @else
        <div class="form-group row">
          <label for="inputName" class="col-sm-3 col-form-label">Alamat</label>
          <div class="col-sm-9">
            <textarea name="alamat" id="" rows="3" class="form-control" placeholder="Alamat">{{ old('alamat', $saya->alamat) }}</textarea>
            @error('alamat') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
          </div>
        </div>
      @endcan

      <div class="form-group row">
          <div class="offset-sm-3 col-sm-9">
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
          <div class="col text-center d-sm-none">
            <button type="submit" class="btn btn-primary form-control">Simpan</button>
          </div>
      </div>

  </form>
