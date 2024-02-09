<div class="modal" id="modal-show">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title fw-bold ">Detail Siswa</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
            <div class="modal-body">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="/img/profile.jpg"
                     alt="User profile picture" id="show-user-foto">
              </div>

              <h3 class="profile-username text-center mb-5" id="show-name"></h3>

              <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <tr class="">
                      <td class="fw-bold">Status Siswa</td>
                      <td style="width: 1px;">:</td>
                      <td class="">
                        <span class="badge show_value" id="show-user-is_aktif"></span>
                      </td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Kelas</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-kelas-name"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">NIS</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-nis"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">NISN</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-nisn"></td>
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
                      <td class="fw-bold">Agama</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-agama"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Status Dalam Keluarga</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-statusdalamkeluarga"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Anak Ke</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-anak_ke"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Alamat Siswa</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-alamatsiswa"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Telepon Siswa</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-teleponsiswa"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Sekolah Asal</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-sekolahasal"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Diterima di Kelas</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-diterimadikelas"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Diterima di Tanggal</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-diterimaditanggal"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Nama Ayah</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-namaayah"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Pekerjaan Ayah</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-pekerjaanayah"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Nama Ibu</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-namaibu"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Pekerjaan Ibu</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-pekerjaanibu"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Alamat Orang Tua</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-alamatortu"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Telepon Orang Tua</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-teleponortu"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Nama Wali</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-namawali"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Pekerjaan Wali</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-pekerjaanwali"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Alamat Wali</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-alamatwali"></td>
                    </tr>
                    <tr class="">
                      <td class="fw-bold">Telepon Wali</td>
                      <td style="width: 1px;">:</td>
                      <td class="show_value" id="show-teleponwali"></td>
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
