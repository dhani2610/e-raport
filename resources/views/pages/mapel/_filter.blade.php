<div class="modal fade" id="modal-filter">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title fw-bold ">Filter Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
            <div class="modal-body">

              <div class="input-group mt-2 " style="width: 100%">
                <div class="input-group-prepend" data-width="20%">
                  <span class="input-group-text">Kelompok Mapel</span>
                </div>
                <select name="kelompok_mapel_id" id="kelompok_mapel_id-select" class="form-control form-select">
                  <option disabled hidden selected>-- Pilih --</option>
                  <option value="">Semua</option>
                  @foreach ($kelompokMapel as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>

            </div>
            <div class="modal-footer justify-content-end">
                <button type="submit" class="btn btn-primary" id="filter-button">Terapkan</button>
            </div>
      </div>
  </div>
</div>
