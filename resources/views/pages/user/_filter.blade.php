<div class="modal fade" id="modal-filter">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title fw-bold ">Filter Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{ route('user.index') }}" method="GET">
            <div class="modal-body">

              <div class="input-group mt-2 " style="width: 100%">
                <div class="input-group-prepend" data-width="20%">
                  <span class="input-group-text">Abc</span>
                </div>
                <select name="abc" id="abc" class="form-control form-select">
                  <option disabled hidden selected>-- Pilih --</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>

            </div>
            <div class="modal-footer justify-content-end">
                <button type="submit" class="btn btn-primary">Terapkan</button>
            </div>
          </form>
      </div>
  </div>
</div>
