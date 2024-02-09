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
          <option value="{{ $item->id }}" {{ $tapel->sekolah_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
      </select>
      @error('sekolah_id') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="name" class="col-sm-3 col-form-label">Tahun Pelajaran @include('partials._wajib')</label>
    <div class="col">
      <div class="row">
        <div class="col-5">
          <input type="text" name="tahun1" value="{{ old('tahun1', $tahun1) }}" class="form-control @error('tahun1') is-invalid @enderror" id="tahun1" placeholder="Ketik Tahun Pelajaran" required>
          @error('tahun1') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
        </div>
        <div class="col-2 align-middle text-center h3">
          /
        </div>
        <div class="col-5">
          <input type="text" name="tahun2" value="{{ old('tahun2', $tahun2) }}" class="form-control @error('tahun2') is-invalid @enderror" id="tahun2" placeholder="Ketik Tahun Pelajaran" required>
          @error('tahun2') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
        </div>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="jk" class="col-sm-3 col-form-label">Semester @include('partials._wajib')</label>
    <div class="col-sm-9">
      <select name="semester" id="semester" class="form-control @error('semester') is-invalid @enderror" data-width="100%" required>
        <option disabled selected hidden>-- Pilih --</option>
        @foreach (['1','2'] as $item)
          <option value="{{ $item }}" {{ old('semester', $tapel->semester) == $item ? 'selected' : '' }}>{{ $item == '1' ? 'Ganjil' : 'Genap' }}</option>
        @endforeach
      </select>
      @error('semester') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="tempat" class="col-sm-3 col-form-label">Tempat Pembagian Raport</label>
    <div class="col-sm-9">
      <input type="text" name="tempat" value="{{ old('tempat', $tapel->tempat) }}" class="form-control @error('tempat') is-invalid @enderror" id="tempat" placeholder="Ketik Tempat Pembagian Raport">
      @error('tempat') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Pembagian Raport</label>
    <div class="col-sm-9">
      <input type="date" name="tanggal" value="{{ old('tanggal', $tapel->tanggal) }}" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="Ketik Tanggal Pembagian Raport">
      @error('tanggal') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="tanggal" class="col-sm-3 col-form-label">Status</label>
    <div class="col-sm-9"> 
      <select name="status" id="" class="form-control">
        <option value="1" {{ $tapel->status == '1' ? 'selected' : ''  }}>Aktif</option>
        <option value="0" {{ $tapel->status == '0' ? 'selected' : ''  }}>Tidak Aktif</option>
      </select>
    </div>
  </div>
  
</div>
