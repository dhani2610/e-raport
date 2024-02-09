  <div class="modal" id="modal-create">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold ">Tambah Data Ekstrakurikuler</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
              <div class="modal-body">

                <div class="alert alert-info alert-dismissible fade show" role="alert" id="alert-info">
                  * adalah kolom yang wajib diisi!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="alert alert-warning alert-dismissible fade d-none" role="alert" id="create-confirm-alert">
                  Harap centang kotak konfirmasi sebelum melanjutkan!
                </div>

                <div class="form-group row">
                  <label for="jk" class="col-sm-3 col-form-label">Sekolah</label>
                  <div class="col-sm-9">
                    <select name="sekolah_id" id="create-sekolah_id" class="form-control selectTwo @error('sekolah_id') is-invalid @enderror" data-width="100%" required>
                      <option disabled selected hidden>-- Pilih --</option>
                      @php
                          if (Auth::user()->sekolah_id == 0) {
                            $array_sekolah = $sekolah;
                          }else{
                            $array_sekolah = $sekolah->where('id',Auth::user()->sekolah_id);
                          }
                      @endphp
                      @foreach ($array_sekolah as $item)
                        <option value="{{ $item->id }}" {{ old('sekolah_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                      @endforeach
                    </select>
                    @error('sekolah_id') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="name" class="col-sm-3 col-form-label">Nama Ekstrakurikuler @include('partials._wajib')</label>
                  <div class="col-sm-9">
                    <input type="text" name="name" value="" class="form-control create-field" id="create-name" placeholder="Ketik Nama Ekstrakurikuler">
                    <small class="text-danger invalid-feedback" id="error-create-name"></small>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="guru_id" class="col-sm-3 col-form-label">Pembina</label>
                  <div class="col-sm-9">
                    <select name="guru_id" id="create-guru_id" class="form-control create-field" data-width="100%">
                      <option selected disabled hidden>-- Pilih --</option>
                      @foreach ($guru as $item)
                        <option value="{{ $item->id }}" {{ old('guru_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                      @endforeach
                    </select>
                    <small class="text-danger invalid-feedback" id="error-create-guru_id"></small>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="tapel_id" class="col-sm-3 col-form-label">Tahun Pelajaran @include('partials._wajib')</label>
                  <div class="col-sm-9">
                    <select name="tapel_id" id="create-tapel_id" class="form-control create-field" data-width="100%">
                      <option selected disabled hidden>-- Pilih --</option>
                      @foreach ($tapel as $item)
                        <option value="{{ $item->id }}" {{ old('tapel_id') == $item->id ? 'selected' : '' }}>{{ $item->tahun_pelajaran() }}</option>
                      @endforeach
                    </select>
                    <small class="text-danger invalid-feedback" id="error-create-tapel_id"></small>
                  </div>
                </div>

              </div>
              <div class="modal-footer justify-content-between">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="store-confirm" required>
                  <label class="form-check-label" for="store-confirm">Saya yakin sudah mengisi dengan benar</label>
                </div>
                <button type="submit" class="btn btn-primary" id="store-button">Simpan</button>
            </div>
        </div>
    </div>
  </div>

  <script>
    function sucToast(success){
    $(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'BERHASIL',
        body: success
      })
    });
    setTimeout(function() {
      $(".toast").fadeOut(500, function() {
        $(this).remove();
      });
    }, 4000);
  }
  </script>
