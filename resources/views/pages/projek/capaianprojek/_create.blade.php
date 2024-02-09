<div class="modal" id="modal-create">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title fw-bold">Tambah Capaian Projek</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
            <div class="modal-body">
              <div class="table-responsive">
                <table id="myTableCreate" class="table table-sm table-hover mb-0" style="width: 100%">
                  <thead>
                    <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                      <th scope="col">No.</th>
                      <th scope="col">Fase</th>
                      <th scope="col">Dimensi</th>
                      <th scope="col">Elemen</th>
                      <th scope="col">Sub Elemen</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="modal-footer justify-content-end">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>
