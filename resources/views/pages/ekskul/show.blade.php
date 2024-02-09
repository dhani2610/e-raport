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
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left text-primary" viewBox="0 0 16 16" style="margin-right: 8px">
              <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
            </svg>
          </a>
          Anggota {{ $ekskul->name }}
        </h4>
      </div>
    </div>
  </div>
</div>


@include('pages.ekskul.anggotaekskul._delete')
@include('pages.ekskul.anggotaekskul._store')


{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <form action="{{ route('anggotaekskul.update', $ekskul->id) }}" method="POST" id="form-update-anggotaekskul">
          @csrf
          @method('PUT')

          <div class="card">
            <div class="card-header">
              <div class="callout callout-warning my-1">
                <div class="col-md-6">
                  <table>
                    <tr>
                      <td class="fw-bold">Nama Ekstrakurikuler</td>
                      <td style="width: 1px;" class="px-2">:</td>
                      <td>{{ $ekskul->name }}</td>
                    </tr>
                    <tr>
                      <td class="fw-bold">Pembina</td>
                      <td style="width: 1px;" class="px-2">:</td>
                      <td>{{ $ekskul->pembina() }}</td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="mt-3">
                <button type="button" class="btn btn-sm btn-success float-left" data-toggle="modal" data-target="#modal-store-anggotaekskul">
                  <i class="fas fa-plus"></i>
                   Tambah Anggota
                </button>
                <button type="button" class="btn btn-sm btn-danger float-right" data-toggle="modal" data-target="#modal-delete-anggotaekskul">
                  <i class="fas fa-trash"></i>
                  Hapus Anggota
                </button>
              </div>
            </div>
            <div class="card-body">
              @if ($anggotaekskul->count() < 1)
                Data masih kosong!
              @else
                <div class="table-responsive">
                  <table id="myTableUpdate" class="table table-sm table-hover mb-0 table-striped ">
                    <thead>
                    <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                      <th scope="col">No.</th>
                      <th scope="col">Nama</th>
                      <th scope="col">NIS</th>
                      <th scope="col">Kelas</th>
                      <th scope="col">Predikat</th>
                      <th scope="col">Deskripsi</th>
                    </tr>
                    </thead>
                  </table>
                </div>
              @endif
            </div>
            @if ($anggotaekskul->count() >= 1)
              <div class="card-footer">
                <div class="form-check d-inline">
                  <input type="hidden" name="kelas_id" id="kelas_id" value="{{ $ekskul->id }}">
                  <input type="checkbox" class="form-check-input" id="update-confirm" required>
                  <label class="form-check-label" for="update-confirm">Saya yakin sudah mengisi dengan benar</label>
                </div>
                <button type="submit" class="btn btn-primary float-right d-inline" id="update-button">Simpan Perubahan</button>
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
  {{-- @include('pages.ekskul.script') --}}
  <script>
    $(document).ready(function() {

      $('#myTableUpdate').dataTable({
          processing: true,
          serveside: true,
          paginate: false,
          ordering: false,
          ajax: {
              url: '/anggotaekskul/{{ $ekskul->id }}/show',
          },
          columns: [
              { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false },
              { data: 'siswa.name', name: 'siswa.name' },
              { data: 'siswa.nis', name: 'siswa.nis' },
              { data: 'siswa.kelas.name', name: 'siswa.kelas.name' },
              { data: 'predikat', name: 'predikat' },
              { data: 'deskripsi', name: 'deskripsi' },
          ]
      });

      // SETUP CSRF
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      // UPDATE PREDIKAT DAN DESKRIPSI
      $('#form-update-anggotaekskul').on('submit', function(e){
        e.preventDefault();
        if (document.getElementById('update-confirm').checked) {
          showLoader();
          $.ajax({
            url: '/anggotaekskul/{{ $ekskul->id }}/update',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,

            success:function(response){
              hideLoader();
              if (response.failed){
                failedToast(response.failed);
              } else {
                $('#myTableUpdate').DataTable().ajax.reload();
                successToast(response.success);
              }
            }

          })
        } else {
          warningToast('Harap centang konfirmasi perubahan terlebih dahulu!');
        }
      });

      // DELETE ANGGOTA
      $('#myTableDelete').dataTable({
        processing:true,
        serveside: true,
        ordering: false,
        ajax: {
          url: '/anggotaekskul/{{ $ekskul->id }}/getdelete',
        },
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
          {data: 'name', name: 'name'},
          {data: 'nis', name: 'nis'},
          {data: 'kelas.name', name: 'kelas.name'},
          {data: 'aksi', name: 'aksi'},
        ]
      });

      $('body').on('click', '.anggota-delete-button', function(e) {
        var id = $(this).data('id');
          showLoaderAtShow();
            $.ajax({
                url: '/anggotaekskul/' + id + '/delete',
                type: 'DELETE',
                success: function(response) {
                  $('#myTableStore').DataTable().ajax.reload();
                  $('#myTableDelete').DataTable().ajax.reload();
                  $('#myTableUpdate').DataTable().ajax.reload();
                  hideLoaderAtShow();
                }
            });
      });

      // TABLE STORE
      $('#myTableStore').dataTable({
        processing:true,
        serveside: true,
        ordering: false,
        ajax: {
          url: '/anggotaekskul/{{ $ekskul->id }}/create',
        },
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
          {data: 'name', name: 'name'},
          {data: 'nis', name: 'nis'},
          {data: 'kelas.name', name: 'kelas.name'},
          {data: 'aksi', name: 'aksi'},
        ]
      });

      // STORE FUNCTION
      $('body').on('click', '.anggota-store-button', function(e) {
        var id = $(this).data('id');
          showLoaderAtShow();
          $.ajax({
              url: '/anggotaekskul/store',
              type: 'POST',
              data: {
                siswa_id: id,
                ekskul_id: '{{ $ekskul->id }}',
              },
              success: function(response) {
                if (response.failed) {
                  $('#modal-store-anggotaekskul').modal('hide');
                  failedToast(response.failed);
                } else if(response.success) {
                  $('#myTableStore').DataTable().ajax.reload();
                  $('#myTableDelete').DataTable().ajax.reload();
                  $('#myTableUpdate').DataTable().ajax.reload();
                }
                hideLoaderAtShow();
              }
          });
      });
    });
  </script>
@endsection
