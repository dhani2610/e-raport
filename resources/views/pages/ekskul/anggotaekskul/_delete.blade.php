<div class="modal" id="modal-delete-anggotaekskul">
  <div class="modal-dialog modal-lg modal-dialog-scrollable modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title fw-bold ">Hapus Anggota {{ $ekskul->name }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
            <div class="modal-body">

              <div class="table-responsive">
                <table id="myTableDelete" class="table table-sm table-hover mb-0 table-striped " style="width: 100%">
                  <thead>
                    <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                      <th scope="col">No.</th>
                      <th scope="col">Nama</th>
                      <th scope="col">NIS</th>
                      <th scope="col">Kelas</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                </table>
              </div>

            </div>
      </div>
  </div>
</div>
