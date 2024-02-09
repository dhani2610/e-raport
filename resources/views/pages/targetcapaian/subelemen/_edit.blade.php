<div class="modal" id="modal-edit">
  <div class="modal-dialog modal-dialog-scrollable">
    <form action="#" id="form-edit">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title fw-bold ">Edit Data Sub Elemen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

            <div class="alert alert-warning alert-dismissible fade d-none" role="alert" id="edit-confirm-alert">
              Harap centang kotak konfirmasi sebelum melanjutkan!
            </div>

            <div class="form-group">
              <input type="hidden" name="elemen_id" id="elemen_id" value="{{ $elemen->id }}">
              <label>Nama Sub Elemen @include('partials._wajib')</label>
              <textarea class="form-control edit-field" name="name" id="edit-name" rows="2" placeholder="Ketik Nama Sub Elemen" required></textarea>
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
