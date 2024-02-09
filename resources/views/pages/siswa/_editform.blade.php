<div class="col-md-6">
  <div class="form-group row">
    <label for="jk" class="col-sm-3 col-form-label">Sekolah</label>
    <div class="col-sm-9">
      <select name="sekolah_id" id="sekolah_id" class="form-control selectTwo @error('sekolah_id') is-invalid @enderror" data-width="100%" required>
        <option disabled selected hidden>-- Pilih --</option>
        @php
            if (Auth::user()->sekolah_id == 0) {
              $array_sekolah = $sekolah;
            }else{
              $array_sekolah = $sekolah->where('id',Auth::user()->sekolah_id);
            }
        @endphp
        @foreach ($array_sekolah as $item)
          <option value="{{ $item->id }}" {{ $siswa->sekolah_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
      </select>
      @error('sekolah_id') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="name" class="col-sm-3 col-form-label">Nama @include('partials._wajib')</label>
    <div class="col-sm-9">
      <input type="text" name="name" value="{{ old('name', $siswa->name) }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Ketik Nama" required>
      @error('name') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="kelas_id" class="col-sm-3 col-form-label">Kelas</label>
    <div class="col-sm-9">
      <select name="kelas_id" id="kelas_id" class="form-control selectTwo @error('kelas_id') is-invalid @enderror" data-width="100%" >
        <option selected value="">-- Pilih --</option>
        @foreach ($kelas as $item)
          <option value="{{ $item->id }}" {{ old('kelas_id', $siswa->kelas_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
      </select>
      @error('kelas_id') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="nis" class="col-sm-3 col-form-label">NIS</label>
    <div class="col-sm-9">
      <input type="number" name="nis" value="{{ old('nis', $siswa->nis) }}" class="form-control @error('nis') is-invalid @enderror" id="nis" placeholder="Ketik NIS">
      @error('nis') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="nisn" class="col-sm-3 col-form-label">NISN</label>
    <div class="col-sm-9">
      <input type="number" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" class="form-control @error('nisn') is-invalid @enderror" id="nisn" placeholder="Ketik NISN" >
      @error('nisn') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="tempatlahir" class="col-sm-3 col-form-label">Tempat Lahir @include('partials._wajib')</label>
    <div class="col-sm-9">
      <input type="text" name="tempatlahir" value="{{ old('tempatlahir', $siswa->tempatlahir) }}" class="form-control @error('tempatlahir') is-invalid @enderror" id="tempatlahir" placeholder="Ketik Tempat Lahir" required>
      @error('tempatlahir') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="tanggallahir" class="col-sm-3 col-form-label">Tanggal Lahir @include('partials._wajib')</label>
    <div class="col-sm-9">
      <input type="date" name="tanggallahir" value="{{ old('tanggallahir', $siswa->tanggallahir) }}" class="form-control @error('tanggallahir') is-invalid @enderror" id="tanggallahir" placeholder="Ketik Tanggal Lahir" required>
      @error('tanggallahir') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin @include('partials._wajib')</label>
    <div class="col-sm-9">
      <select name="jk" id="jk" class="form-control selectTwo @error('jk') is-invalid @enderror" data-width="100%" required>
        <option disabled selected hidden>-- Pilih --</option>
        <option value="L" {{ old('jk', $siswa->jk) == 'L' ? 'selected' : '' }}>Laki-Laki</option>
        <option value="P" {{ old('jk', $siswa->jk) == 'P' ? 'selected' : '' }}>Perempuan</option>
      </select>
      @error('jk') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="agama" class="col-sm-3 col-form-label">Agama @include('partials._wajib')</label>
    <div class="col-sm-9">
      <select name="agama" id="agama" class="form-control selectTwo @error('agama') is-invalid @enderror" data-width="100%" required>
        <option disabled selected hidden>-- Pilih --</option>
        <option value="Islam" {{ old('Islam', $siswa->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
        <option value="Katolik" {{ old('Katolik', $siswa->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
        <option value="Protestan" {{ old('Protestan', $siswa->agama) == 'Protestan' ? 'selected' : '' }}>Protestan</option>
        <option value="Hindu" {{ old('Hindu', $siswa->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
        <option value="Buddha" {{ old('Buddha', $siswa->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
        <option value="Konghucu" {{ old('Konghucu', $siswa->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
      </select>
      @error('agama') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="statusdalamkeluarga" class="col-sm-3 col-form-label">Status Dalam Keluarga</label>
    <div class="col-sm-9">
      <select name="statusdalamkeluarga" id="statusdalamkeluarga" class="form-control selectTwo @error('statusdalamkeluarga') is-invalid @enderror" data-width="100%" >
        <option disabled selected hidden>-- Pilih --</option>
        <option value="AK" {{ old('AK', $siswa->statusdalamkeluarga) == 'AK' ? 'selected' : '' }}>Anak Kandung</option>
        <option value="AA" {{ old('AA', $siswa->statusdalamkeluarga) == 'AA' ? 'selected' : '' }}>Anak Angkat</option>
        <option value="AT" {{ old('AT', $siswa->statusdalamkeluarga) == 'AT' ? 'selected' : '' }}>Anak Tiri</option>
      </select>
      @error('statusdalamkeluarga') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="anak_ke" class="col-sm-3 col-form-label">Anak Ke</label>
    <div class="col-sm-9">
      <input type="number" name="anak_ke" value="{{ old('anak_ke', $siswa->anak_ke) }}" class="form-control @error('anak_ke') is-invalid @enderror" id="anak_ke" placeholder="Ketik Anak Ke" >
      @error('anak_ke') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="alamatsiswa" class="col-sm-3 col-form-label">Alamat Siswa </label>
    <div class="col-sm-9">
      <textarea type="text" name="alamatsiswa" class="form-control @error('alamatsiswa') is-invalid @enderror" id="alamatsiswa" placeholder="Ketik Alamat Siswa" >{{ old('alamatsiswa', $siswa->alamatsiswa) }}</textarea>
      @error('alamatsiswa') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="teleponsiswa" class="col-sm-3 col-form-label">Telepon Siswa</label>
    <div class="col-sm-9">
      <input type="number" name="teleponsiswa" value="{{ old('teleponsiswa', $siswa->teleponsiswa) }}" class="form-control @error('teleponsiswa') is-invalid @enderror" id="teleponsiswa" placeholder="Ketik Telepon Siswa" >
      @error('teleponsiswa') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="sekolahasal" class="col-sm-3 col-form-label">Sekolah Asal</label>
    <div class="col-sm-9">
      <input type="text" name="sekolahasal" value="{{ old('sekolahasal', $siswa->sekolahasal) }}" class="form-control @error('sekolahasal') is-invalid @enderror" id="sekolahasal" placeholder="Ketik Sekolah Asal" >
      @error('sekolahasal') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="diterimadikelas" class="col-sm-3 col-form-label">Diterima di Kelas</label>
    <div class="col-sm-9">
      <select name="diterimadikelas" id="diterimadikelas" class="form-control selectTwo @error('diterimadikelas') is-invalid @enderror" data-width="100%" >
        <option disabled selected hidden>-- Pilih --</option>
        @foreach ($tingkat as $item)
          <option value="{{ $item->angka }}" {{ old('diterimadikelas', $siswa->diterimadikelas) == $item->angka ? 'selected' : '' }}>{{ $item->angka }}</option>
        @endforeach
      </select>
      @error('diterimadikelas') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="diterimaditanggal" class="col-sm-3 col-form-label">Tanggal Diterima</label>
    <div class="col-sm-9">
      <input type="date" name="diterimaditanggal" value="{{ old('diterimaditanggal', $siswa->diterimaditanggal) }}" class="form-control @error('diterimaditanggal') is-invalid @enderror" id="diterimaditanggal" placeholder="Ketik Tanggal Lahir" >
      @error('diterimaditanggal') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="namaayah" class="col-sm-3 col-form-label">Nama Ayah</label>
    <div class="col-sm-9">
      <input type="text" name="namaayah" value="{{ old('namaayah', $siswa->namaayah) }}" class="form-control @error('namaayah') is-invalid @enderror" id="namaayah" placeholder="Ketik Nama Ayah" >
      @error('namaayah') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="pekerjaanayah" class="col-sm-3 col-form-label">Pekerjaan Ayah</label>
    <div class="col-sm-9">
      <input type="text" name="pekerjaanayah" value="{{ old('pekerjaanayah', $siswa->pekerjaanayah) }}" class="form-control @error('pekerjaanayah') is-invalid @enderror" id="pekerjaanayah" placeholder="Ketik Pekerjaan Ayah" >
      @error('pekerjaanayah') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="namaibu" class="col-sm-3 col-form-label">Nama Ibu</label>
    <div class="col-sm-9">
      <input type="text" name="namaibu" value="{{ old('namaibu', $siswa->namaibu) }}" class="form-control @error('namaibu') is-invalid @enderror" id="namaibu" placeholder="Ketik Nama Ibu" >
      @error('namaibu') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="pekerjaanibu" class="col-sm-3 col-form-label">Pekerjaan Ibu</label>
    <div class="col-sm-9">
      <input type="text" name="pekerjaanibu" value="{{ old('pekerjaanibu', $siswa->pekerjaanibu) }}" class="form-control @error('pekerjaanibu') is-invalid @enderror" id="pekerjaanibu" placeholder="Ketik Pekerjaan Ibu" >
      @error('pekerjaanibu') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="alamatortu" class="col-sm-3 col-form-label">Alamat Orang Tua </label>
    <div class="col-sm-9">
      <textarea type="text" name="alamatortu" class="form-control @error('alamatortu') is-invalid @enderror" id="alamatortu" placeholder="Ketik Alamat Orang Tua" >{{ old('alamatortu', $siswa->alamatortu) }}</textarea>
      @error('alamatortu') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="teleponortu" class="col-sm-3 col-form-label">Telepon Orang Tua</label>
    <div class="col-sm-9">
      <input type="number" name="teleponortu" value="{{ old('teleponortu', $siswa->teleponortu) }}" class="form-control @error('teleponortu') is-invalid @enderror" id="teleponortu" placeholder="Ketik Telepon Orang Tua" >
      @error('teleponortu') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="namawali" class="col-sm-3 col-form-label">Nama Wali</label>
    <div class="col-sm-9">
      <input type="text" name="namawali" value="{{ old('namawali', $siswa->namawali) }}" class="form-control @error('namawali') is-invalid @enderror" id="namawali" placeholder="Ketik Nama Wali" >
      @error('namawali') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="pekerjaanwali" class="col-sm-3 col-form-label">Pekerjaan Wali</label>
    <div class="col-sm-9">
      <input type="text" name="pekerjaanwali" value="{{ old('pekerjaanwali', $siswa->pekerjaanwali) }}" class="form-control @error('pekerjaanwali') is-invalid @enderror" id="pekerjaanwali" placeholder="Ketik Pekerjaan Wali" >
      @error('pekerjaanwali') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="alamatwali" class="col-sm-3 col-form-label">Alamat Wali </label>
    <div class="col-sm-9">
      <textarea type="text" name="alamatwali" class="form-control @error('alamatwali') is-invalid @enderror" id="alamatwali" placeholder="Ketik Alamat Wali" >{{ old('alamatwali', $siswa->alammatwali) }}</textarea>
      @error('alamatwali') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="teleponwali" class="col-sm-3 col-form-label">Telepon Wali</label>
    <div class="col-sm-9">
      <input type="number" name="teleponwali" value="{{ old('teleponwali', $siswa->teleponwali) }}" class="form-control @error('teleponwali') is-invalid @enderror" id="teleponwali" placeholder="Ketik Telepon Wali" >
      @error('teleponwali') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group row">
    <label for="is_aktif" class="col-sm-3 col-form-label">Status Siswa @include('partials._wajib')</label>
    <div class="col-sm-9">
      <select name="is_aktif" id="is_aktif" class="form-control selectTwo @error('is_aktif') is-invalid @enderror" data-width="100%" required>
        <option disabled selected hidden>-- Pilih --</option>
        <option value="1" {{ old('is_aktif', $siswa->user->is_aktif) == '1' ? 'selected' : '' }}>AKTIF</option>
        <option value="0" {{ old('is_aktif', $siswa->user->is_aktif) == '0' ? 'selected' : '' }}>NON-AKTIF</option>
      </select>
      @error('is_aktif') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-3 col-form-label">Email Akun</label>
    <div class="col-sm-9">
      <input type="email" name="email" value="{{ old('email', $siswa->user->email) }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Ketik Email" >
      @error('email') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="username" class="col-sm-3 col-form-label">Username Akun @include('partials._wajib')</label>
    <div class="col-sm-9">
      <input type="username" name="username" value="{{ old('username', $siswa->user->username) }}" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Ketik Username" required>
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
