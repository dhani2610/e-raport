<div class="form-group row">
  <label for="abc" class="col-sm-4 col-form-label">Nama Sekolah</label>
  <div class="col-sm-8">
    <input type="text" value="{{ old('name', $sekolah->name) }}" class="form-control edit-data-field" name="name" id="edit-data-name" placeholder="Masukkan Nama Sekolah">
    <span class="invalid-feedback mt-1" id="error-data-name"></span>
  </div>
</div>
<div class="form-group row">
  <label for="npsn" class="col-sm-4 col-form-label">NPSN</label>
  <div class="col-sm-8">
    <input type="number" value="{{ old('npsn', $sekolah->npsn) }}" class="form-control edit-data-field" name="npsn" id="edit-data-npsn" placeholder="Masukkan NPSN">
    <span class="invalid-feedback mt-1" id="error-data-npsn"></span>
  </div>
</div>
<div class="form-group row">
  <label for="nss" class="col-sm-4 col-form-label">NSS</label>
  <div class="col-sm-8">
    <input type="number" value="{{ old('nss', $sekolah->nss) }}" class="form-control edit-data-field" name="nss" id="edit-data-nss" placeholder="Masukkan NSS">
    <span class="invalid-feedback mt-1" id="error-data-nss"></span>
  </div>
</div>
<div class="form-group row">
  <label for="kodepos" class="col-sm-4 col-form-label">Kode POS</label>
  <div class="col-sm-8">
    <input type="number" value="{{ old('kodepos', $sekolah->kodepos) }}" class="form-control edit-data-field" name="kodepos" id="edit-data-kodepos" placeholder="Masukkan Kode Pos">
    <span class="invalid-feedback mt-1" id="error-data-kodepos"></span>
  </div>
</div>
<div class="form-group row">
  <label for="telepon" class="col-sm-4 col-form-label">Telepon</label>
  <div class="col-sm-8">
    <input type="text" value="{{ old('telepon', $sekolah->telepon) }}" class="form-control edit-data-field" name="telepon" id="edit-data-telepon" placeholder="Masukkan Telepon">
    <span class="invalid-feedback mt-1" id="error-data-telepon"></span>
  </div>
</div>
<div class="form-group row">
  <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
  <div class="col-sm-8">
    <textarea type="text" class="form-control edit-data-field" name="alamat" placeholder="Masukkan Alamat" id="edit-data-alamat">{{ old('alamat', $sekolah->alamat) }}</textarea>
    <span class="invalid-feedback mt-1" id="error-data-alamat"></span>
  </div>
</div>
<div class="form-group row">
  <label for="email" class="col-sm-4 col-form-label">Email</label>
  <div class="col-sm-8">
    <input type="text" value="{{ old('email', $sekolah->email) }}" class="form-control edit-data-field" name="email" placeholder="Masukkan Email" id="edit-data-email">
    <span class="invalid-feedback mt-1" id="error-data-email"></span>
  </div>
</div>
<div class="form-group row">
  <label for="website" class="col-sm-4 col-form-label">Website</label>
  <div class="col-sm-8">
    <input type="text" value="{{ old('website', $sekolah->website) }}" class="form-control edit-data-field " name="website" id="edit-data-website" placeholder="Masukkan Website">
    <span class="invalid-feedback mt-1" id="error-data-website"></span>
  </div>
</div>
<div class="form-group row">
  <label for="namakepsek" class="col-sm-4 col-form-label">Kepala Sekolah</label>
  <div class="col-sm-8">
    <input type="text" value="{{ old('namakepsek', $sekolah->namakepsek) }}" class="form-control edit-data-field " name="namakepsek" id="edit-data-namakepsek" placeholder="Masukkan nama Kepala Sekolah">
    <span class="invalid-feedback mt-1" id="error-data-namakepsek"></span>
  </div>
</div>
<div class="form-group row">
  <label for="nipkepsek" class="col-sm-4 col-form-label">NIP Kepala Sekolah</label>
  <div class="col-sm-8">
    <input type="number" value="{{ old('nipkepsek', $sekolah->nipkepsek) }}" class="form-control edit-data-field " name="nipkepsek" id="edit-data-nipkepsek" placeholder="Masukkan NIP Kepala Sekolah">
    <span class="invalid-feedback mt-1" id="error-data-nipkepsek"></span>
  </div>
</div>
