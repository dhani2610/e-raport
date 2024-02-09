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

              @can('admin')
              <div class="input-group mt-2 " style="width: 100%">
                <div class="input-group-prepend" data-width="20%">
                  <span class="input-group-text">Kelas</span>
                </div>
                <select name="kelas_id" id="kelas_id_select" class="form-control form-select">
                  <option disabled hidden selected>-- Pilih --</option>
                  <option value="">Semua</option>
                  <option value="bukananggota">Bukan Anggota Kelas</option>
                  @foreach ($kelas as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
              @endcan

              <div class="input-group mt-2 " style="width: 100%">
                <div class="input-group-prepend" data-width="20%">
                  <span class="input-group-text">Jenis Kelamin</span>
                </div>
                <select name="jk" id="jk_select" class="form-control form-select">
                  <option disabled hidden selected>-- Pilih --</option>
                  <option value="">Semua</option>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>

              <div class="input-group mt-2 " style="width: 100%">
                <div class="input-group-prepend" data-width="20%">
                  <span class="input-group-text">Status Akun</span>
                </div>
                <select name="is_aktif" id="is_aktif_select" class="form-control form-select">
                  <option disabled hidden selected>-- Pilih --</option>
                  <option value="">Semua</option>
                  <option value="1">Aktif</option>
                  <option value="0">Non-Aktif</option>
                </select>
              </div>

            </div>
            <div class="modal-footer justify-content-end">
                <button type="submit" class="btn btn-primary" id="filter-button">Terapkan</button>
            </div>
      </div>
  </div>
</div>
