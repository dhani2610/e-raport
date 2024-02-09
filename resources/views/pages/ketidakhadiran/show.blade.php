@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">
          <a href="#" class="float-xs-start" onclick="history.back()">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                class="bi bi-arrow-left text-primary" viewBox="0 0 16 16" style="margin-right: 8px">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
            </svg>
            </a>
          Data Ketidakhadiran</h4>
      </div>
    </div>
  </div>
</div>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <form action="{{ route('ketidakhadiran.update', $kelas->id) }}" method="POST" id="form-update-ketidakhadiran">
          @csrf
          @method('PUT')

          <div class="card">
            <div class="card-header">
              <div class="callout callout-warning my-1">
                <div class="col-md-6">
                  <table>
                    <tr>
                      <td class="fw-bold">Kelas</td>
                      <td style="width: 1px;" class="px-2">:</td>
                      <td>{{ $kelas->name }}</td>
                    </tr>
                    <tr>
                      <td class="fw-bold">Wali Kelas</td>
                      <td style="width: 1px;" class="px-2">:</td>
                      <td>{{ $kelas->wali_kelas() }}</td>
                    </tr>
                    <tr>
                      <td class="fw-bold">Tahun Pelajaran</td>
                      <td style="width: 1px;" class="px-2">:</td>
                      <td>{{ $kelas->tapel->tahun_pelajaran() }}</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="card-body">
              @if ($siswa->count() < 1)
                Data masih kosong!
              @else
                <div class="table-responsive">
                  <table id="myTableShow" class="table table-sm table-hover mb-0 table-striped ">
                    <thead>
                    <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                      <th scope="col">No.</th>
                      <th scope="col" style="min-width: 150px">Nama</th>
                      <th scope="col">NIS</th>
                      <th scope="col">L/P</th>
                      <th scope="col" style="min-width: 80px">Sakit</th>
                      <th scope="col" style="min-width: 80px">Izin</th>
                      <th scope="col" style="min-width: 80px">Tanpa Keterangan</th>
                    </tr>
                    </thead>
                  </table>
                </div>
              @endif
            </div>
            @if ($siswa->count() >= 1)
              <div class="card-footer">
                <div class="form-check d-inline">
                  <input type="hidden" name="kelas_id" id="kelas_id" value="{{ $kelas->id }}">
                  <input type="checkbox" class="form-check-input" id="update-confirm" required>
                  <label class="form-check-label" for="update-confirm">Saya yakin sudah mengisi dengan benar</label>
                </div>
                <button type="submit" class="btn btn-primary float-right d-inline" id="update-button">Perbarui</button>
              </div>
            @endif
          </div>

        </form>
      </div>
    </div>
  </div>
</section>

@endsection

@section('js')

@include('partials.toast2')
 <script>
  $(document).ready(function() {
    $('#myTableShow').dataTable({
        processing: true,
        serveside: true,
        paginate: false,
        ajax: {
            url: '/ketidakhadiran/{{ $kelas->id }}',
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: true,
                searchable: false
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'nis',
                name: 'nis'
            },
            {
                data: 'jk',
                name: 'jk'
            },
            {
                data: 'ketidakhadiran.sakit',
                name: 'ketidakhadiran.sakit'
            },
            {
                data: 'ketidakhadiran.izin',
                name: 'ketidakhadiran.izin'
            },
            {
                data: 'ketidakhadiran.tk',
                name: 'ketidakhadiran.tk'
            },
        ]
    });

    $('#form-update-ketidakhadiran').on('submit', function(e){
      e.preventDefault();
      if (document.getElementById('update-confirm').checked) {
        showLoader();
        $.ajax({
          url: '/ketidakhadiran/{{ $kelas->id }}',
          type: 'POST',
          data: new FormData(this),
          contentType: false,
          processData: false,

          success:function(response){
            hideLoader();
            if (response.failed){
              failedToast(response.failed);
            } else {
              $('#myTableShow').DataTable().ajax.reload();
              successToast(response.success);
            }
          }

        })
      } else {
        warningToast('Harap centang konfirmasi perubahan terlebih dahulu!');
      }
    });
  });
 </script>
@endsection
