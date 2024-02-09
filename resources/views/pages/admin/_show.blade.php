<div class="modal" id="modal-show">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title fw-bold ">Detail Admin</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
            <div class="modal-body">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="/img/profile.jpg" alt="User profile picture" id="show-user-foto">
              </div>

              <h3 class="profile-username text-center mb-5" id="show-name"></h3>

              <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <tr class="">
                      <td class="fw-bold">Status Admin</td>
                      <td style="width: 1px;">:</td>
                      <td class="">
                        <span class="badge show_value" id="show-user-is_aktif"></span>
                      </td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">NIP</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-nip"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">NUPTK</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-nuptk"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Tempat, Tanggal Lahir</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-ttl"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Jenis Kelamin</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-jk"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Telepon</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-telepon"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Alamat</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-alamat"></td>
                    </tr>
                </table>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-warning edit-button" data-id="" id="show-edit-route">Edit</button>
          </div>
      </div>
  </div>
</div>
