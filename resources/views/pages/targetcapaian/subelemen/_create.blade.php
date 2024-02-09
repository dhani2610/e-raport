<div class="modal" id="modal-create">
  <div class="modal-dialog modal-dialog-scrollable">
    <form action="#" id="form-create">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title fw-bold ">Tambah Data Sub Elemen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

            <div class="alert alert-warning alert-dismissible fade d-none" role="alert" id="create-confirm-alert">
              Harap centang kotak konfirmasi sebelum melanjutkan!
            </div>

            <div class="form-group">
              <input type="hidden" name="elemen_id" id="elemen_id" value="{{ $elemen->id }}">
              <label>Nama Sub Elemen @include('partials._wajib')</label>
              <textarea class="form-control create-field" name="name" id="create-name" rows="2" placeholder="Ketik Nama Sub Elemen" required></textarea>
              <small class="text-danger invalid-feedback" id="error-create-name"></small>
            </div>

          </div>
          <div class="modal-footer justify-content-between">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="store-confirm" required checked>
              <label class="form-check-label" for="store-confirm">Saya yakin sudah mengisi dengan benar</label>
            </div>
            <button type="submit" class="btn btn-primary" id="store-button">Simpan</button>
          </div>
      </div>
    </form>
  </div>
</div>
