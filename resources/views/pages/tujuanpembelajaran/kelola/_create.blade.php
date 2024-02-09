<div class="modal fade" id="modal-create">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('tujuanpembelajaran.store') }}" method="POST" id="form-store-tp">
    @csrf

      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title fw-bold ">Tambah Tujuan Pembelajaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
            <div class="modal-body">

              <div class="form-group">
                <label>Tujuan Pembelajaran (Max 150 Karakter)</label>
                <textarea class="form-control create-keterangan" name="keterangan[]" id="keterangan" rows="3" placeholder="Ketik Tujuan Pembelajaran" oninput="limitInputTP(this, document.getElementById('error-create-keterangan'))" required></textarea>
              </div>

              <div class="" id="duplikat">

              </div>

            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" name="pembelajaran_id" id="pembelajaran_id" value="{{ $pembelajaran->id }}">
                <button type="button" class="btn btn-info" id="duplikat-keterangan">Tambah TP</button>
                <button type="button" class="btn btn-danger d-none" id="reset">Reset</button>
                <button type="submit" class="btn btn-primary" id="store-button">Simpan</button>
            </div>
      </div>
    </form>
  </div>
</div>
