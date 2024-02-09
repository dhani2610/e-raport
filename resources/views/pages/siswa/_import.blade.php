<div class="modal fade" id="modal-import">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title fw-bold ">Import Data Siswa</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data">
          @csrf

            <div class="modal-body">

              <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert-info">
                <b> Penting! </b> File yang diunggah harus berupa dokumen Microsoft Excel dengan ekstensi .xlsx <br>
                <a href="/import/FORMAT IMPORT DATA SISWA RAPORT MERDEKA.xlsx" class="text-primary" download>Download Format Import</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="input-group mb-3">
                <input type="file" name="file" class="form form-control" id="file" required>
              </div>

            </div>
            <div class="modal-footer justify-content-end">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="import-confirm" required>
                <label class="form-check-label" for="import-confirm">Saya yakin sudah mengisi dengan benar</label>
              </div>
              <button type="submit" class="btn btn-primary" id="confirm-import-button">Simpan</button>
            </div>
          </form>
      </div>
  </div>
</div>
