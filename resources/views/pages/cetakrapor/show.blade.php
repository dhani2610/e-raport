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
          Cetak Rapor {{ $kelas->name }}
        </h4>
      </div>
    </div>
  </div>
</div>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <div class="callout callout-warning my-1 bg-light">
              <table class="table table-borderless mb-0 table-sm">
                <tr>
                  <td class="fw-bold">Nama Kelas</td>
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
                <tr>
                  <td class="fw-bold">Jenis Kertas</td>
                  <td style="width: 1px;" class="px-2">:</td>
                  <td>
                    <select name="paper-select" class="form form-control" id="paper-select">
                      @foreach (['F4', 'A4'] as $item)
                        <option value="{{ $item == 'F4' ? 'Folio' : 'A4' }}">{{ $item }}</option>
                      @endforeach
                    </select>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if ($siswa->count() < 1)
              Data masih kosong!
            @else
              <div class="table-responsive">
                <table id="myTable" class="table table-sm table-hover mb-0">
                  <thead>
                  <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                    <th scope="col">No.</th>
                    <th scope="col">NIS/NISN</th>
                    <th scope="col">Nama</th>
                    <th scope="col">L/P</th>
                    <th scope="col">Aksi</th>
                  </tr>
                  </thead>
                </table>
              </div>
            @endif
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('js')
 <script>
  $(document).ready(function(){
    $('#myTable').DataTable({
      processing: true,
      serverside: true,
      ordering: false,
      ajax: {
        url: '/cetakrapor/{{ $kelas->id }}',
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'nis-nisn', name: 'nis-nisn'},
        {data: 'name', name: 'name'},
        {data: 'jk', name: 'jk'},
        {data: 'aksi', name: 'aksi'},
      ],
    });

    // kelengkapan
    $('body').on('click', '.kelengkapan-button', function(){
      window.open('/cetakrapor/kelengkapan/' + $(this).data('id') + '/' + $('#paper-select').val(), '_blank');
    });

    // semester
    $('body').on('click', '.semester-button', function(){
      window.open('/cetakrapor/semester/' + $(this).data('id') + '/' + $('#paper-select').val(), '_blank');
    });

    // p5
    $('body').on('click', '.p5-button', function(){
      window.open('/cetakrapor/p5/' + $(this).data('id') + '/' + $('#paper-select').val(), '_blank');
    });

  })
 </script>
@endsection
