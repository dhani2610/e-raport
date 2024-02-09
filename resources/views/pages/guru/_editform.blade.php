<div class="col-md-6">
  <div class="form-group row">
    <label for="jk" class="col-sm-3 col-form-label">Sekolah</label>
    <div class="col-sm-9">
      <select name="sekolah_id" id="sekolah_id" class="form-control selectTwo @error('sekolah_id') is-invalid @enderror" data-width="100%" required>
        <option disabled hidden>-- Pilih --</option>
        @php
            if (Auth::user()->sekolah_id == 0) {
              $array_sekolah = $sekolah;
            }else{
              $array_sekolah = $sekolah->where('id',Auth::user()->sekolah_id);
            }
        @endphp
        @foreach ($array_sekolah as $item)
          <option value="{{ $item->id }}" {{ $guru->sekolah_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
      </select>
      @error('sekolah_id') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="name" class="col-sm-3 col-form-label">Nama @include('partials._wajib')</label>
    <div class="col-sm-9">
      <input type="text" name="name" value="{{ old('name', $guru->name) }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Ketik Nama" required>
      @error('name') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="nip" class="col-sm-3 col-form-label">NIP</label>
    <div class="col-sm-9">
      <input type="number" name="nip" value="{{ old('nip', $guru->nip) }}" class="form-control @error('nip') is-invalid @enderror" id="nip" placeholder="Ketik NIP">
      @error('nip') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="nuptk" class="col-sm-3 col-form-label">NUPTK</label>
    <div class="col-sm-9">
      <input type="text" name="nuptk" value="{{ old('nuptk', $guru->nuptk) }}" class="form-control @error('nuptk') is-invalid @enderror" id="nuptk" placeholder="Ketik NUPTK" >
      @error('nuptk') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="tempatlahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
    <div class="col-sm-9">
      <input type="text" name="tempatlahir" value="{{ old('tempatlahir', $guru->tempatlahir) }}" class="form-control @error('tempatlahir') is-invalid @enderror" id="tempatlahir" placeholder="Ketik Tempat Lahir">
      @error('tempatlahir') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="tanggallahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
    <div class="col-sm-9">
      <input type="date" name="tanggallahir" value="{{ old('tanggallahir', $guru->tanggallahir) }}" class="form-control @error('tanggallahir') is-invalid @enderror" id="tanggallahir" placeholder="Ketik Tanggal Lahir">
      @error('tanggallahir') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin @include('partials._wajib')</label>
    <div class="col-sm-9">
      <select name="jk" id="jk" class="form-control @error('jk') is-invalid @enderror" data-width="100%" required>
        <option disabled selected hidden>-- Pilih --</option>
        <option value="L" {{ old('jk', $guru->jk) == 'L' ? 'selected' : '' }}>Laki-Laki</option>
        <option value="P" {{ old('jk', $guru->jk) == 'P' ? 'selected' : '' }}>Perempuan</option>
      </select>
      @error('jk') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="alamat" class="col-sm-3 col-form-label">Alamat </label>
    <div class="col-sm-9">
      <textarea type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Ketik Alamat" >{{ old('alamat', $guru->alamat) }}</textarea>
      @error('alamat') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="telepon" class="col-sm-3 col-form-label">Telepon</label>
    <div class="col-sm-9">
      <input type="number" name="telepon" value="{{ old('telepon', $guru->telepon) }}" class="form-control @error('telepon') is-invalid @enderror" id="telepon" placeholder="Ketik Telepon" >
      @error('telepon') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group row">
    <label for="is_aktif" class="col-sm-3 col-form-label">Status Guru @include('partials._wajib')</label>
    <div class="col-sm-9">
      <select name="is_aktif" id="is_aktif" class="form-control @error('is_aktif') is-invalid @enderror" data-width="100%" required>
        <option disabled selected hidden>-- Pilih --</option>
        <option value="1" {{ old('is_aktif', $guru->user->is_aktif) == '1' ? 'selected' : '' }}>AKTIF</option>
        <option value="0" {{ old('is_aktif', $guru->user->is_aktif) == '0' ? 'selected' : '' }}>NON-AKTIF</option>
      </select>
      @error('is_aktif') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-3 col-form-label">Email Akun</label>
    <div class="col-sm-9">
      <input type="email" name="email" value="{{ old('email', $guru->user->email) }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Ketik Email" >
      @error('email') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="username" class="col-sm-3 col-form-label">Username Akun @include('partials._wajib')</label>
    <div class="col-sm-9">
      <input type="username" name="username" value="{{ old('username', $guru->user->username) }}" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Ketik Username" required>
      @error('username') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <div class="input-group">
    <label for="password" class="col-sm-3 col-form-label">Password Baru <small>(Opsional)</small></label>
      <div class="col-sm-9 input-group mb-3">
        <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Ketik Password Baru">
        <div class="input-group-append" onclick="togglePassword()">
          <span class="input-group-text" style="cursor: pointer;"><i class="fa fa-eye-slash" id="eye-icon"></i></span>
        </div>
        @error('password') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      var x = document.getElementById('password');
      var y = document.getElementById('eye-icon');
      if (x.type === 'password') {
        x.type = 'text';
        y.classList.add('fa-eye');
        y.classList.remove('fa-eye-slash');
        y.classList.add('text-primary');
      } else {
        x.type = 'password';
        y.classList.add('fa-eye-slash');
        y.classList.remove('text-primary');
        y.classList.remove('fa-eye');
      }
    }
  </script>
</div>
