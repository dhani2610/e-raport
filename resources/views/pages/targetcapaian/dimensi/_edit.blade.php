<div class="modal" id="modal-edit">
  <div class="modal-dialog modal-dialog-scrollable">
    <form action="#" id="form-edit">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title fw-bold ">Edit Data Dimensi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

            <div class="alert alert-warning alert-dismissible fade d-none" role="alert" id="edit-confirm-alert">
              Harap centang kotak konfirmasi sebelum melanjutkan!
            </div>

            <div class="form-group row">
              <label for="jk" class="col-sm-3 col-form-label">Sekolah</label>
              <div class="col-sm-9">
                <select name="sekolah_id" id="edit-sekolah_id" class="form-control selectTwo edit-field @error('sekolah_id') is-invalid @enderror" data-width="100%" required>
                  <option disabled selected hidden>-- Pilih --</option>
                  @php
                      if (Auth::user()->sekolah_id == 0) {
                        $array_sekolah = $sekolah;
                      }else{
                        $array_sekolah = $sekolah->where('id',Auth::user()->sekolah_id);
                      }
                  @endphp
                  @foreach ($array_sekolah as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
                @error('sekolah_id') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="form-group">
              <label>Nama Dimensi @include('partials._wajib')</label>
              <textarea class="form-control edit-field" name="name" id="edit-name" rows="2" placeholder="Ketik Nama Dimensi" required></textarea>
              <small class="text-danger invalid-feedback" id="error-edit-name"></small>
            </div>

          </div>
          <div class="modal-footer justify-content-between">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="update-confirm" required checked>
              <label class="form-check-label" for="update-confirm">Saya yakin sudah mengisi dengan benar</label>
            </div>
            <button type="submit" class="btn btn-primary" id="update-button">Simpan Perubahan</button>
          </div>
      </div>
    </form>
  </div>
</div>
