<div class="modal fade" id="modal-logout">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title fw-bold ">Logout</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p>Apakah anda yakin akan keluar dari <span id="logoutTitle"> E-RAPORT KURIKULUM MERDEKA </span>?</p>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <form action="/logout" method="POST">
              @csrf
                  <button type="submit" class="btn btn-danger">Keluar</button>
              </form>
          </div>
      </div>
  </div>
</div>
