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
                  <span class="input-group-text">Kelas</span>
                </div>
                <select name="kelas_id" id="kelas_id-select" class="form-control form-select">
                  <option disabled hidden selected>-- Pilih --</option>
                  <option value="">Semua</option>
                  @foreach ($kelas as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>

            @can('admin')
              <div class="input-group mt-2 " style="width: 100%">
                <div class="input-group-prepend" data-width="20%">
                  <span class="input-group-text">Guru/Koordinator</span>
                </div>
                <select name="guru_id" id="guru_id-select" class="form-control form-select">
                  <option disabled hidden selected>-- Pilih --</option>
                  <option value="">Semua</option>
                  @foreach ($guru as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            @endcan

            </div>
            <div class="modal-footer justify-content-end">
                <button type="submit" class="btn btn-primary" id="filter-button">Terapkan</button>
            </div>
      </div>
  </div>
</div>
