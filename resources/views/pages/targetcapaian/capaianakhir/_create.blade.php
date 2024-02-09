<div class="modal" id="modal-create">
  <div class="modal-dialog modal-dialog-scrollable">
    <form action="#" id="form-create">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title fw-bold ">Tambah Data Capaian Akhir</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

            <div class="alert alert-warning alert-dismissible fade d-none" role="alert" id="create-confirm-alert">
              Harap centang kotak konfirmasi sebelum melanjutkan!
            </div>

            <div class="input-group my-2 " style="width: 100%">
              <div class="input-group-prepend" data-width="20%">
                <span class="input-group-text">Fase</span>
              </div>
              <select name="fase_id" id="create-fase_id" class="form-control form-select create-field" required>
                <option disabled hidden selected>-- Pilih --</option>
                @foreach ($fase as $item)
                  <option value="{{ $item->id }}" {{ old('fase_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
              </select>
              <small class="text-danger invalid-feedback" id="error-create-fase_id"></small>
            </div>

            <div class="form-group">
              <input type="hidden" name="sub_elemen_id" id="create-sub_elemen_id" value="{{ $subelemen->id }}">
              <label>Capaian Akhir @include('partials._wajib')</label>
              <textarea class="form-control create-field" name="name" id="create-name" rows="2" placeholder="Ketik Nama Capaian Akhir" required></textarea>
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
