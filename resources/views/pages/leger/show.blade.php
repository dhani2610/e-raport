@extends('layouts.main')

@section('css')
  <link href="https://cdn.datatables.net/v/bs4/jq-3.7.0/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/kt-2.11.0/datatables.min.css" rel="stylesheet">
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
          Leger {{ $kelas->name }}
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
              </table>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if (!$nilaiSiswa || $pembelajarans->count() < 1)
              Data masih kosong!
            @else
              <div class="table-responsive">
                <table id="myTable" class="table table-sm table-hover mb-0 fs-14">
                  <thead>
                    <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}" rowwspan="2">
                      <th rowspan="2">No.</th>
                      <th rowspan="2">NIS</th>
                      <th rowspan="2" style="min-width: 200px">NAMA</th>
                      <th rowspan="2">L/P</th>
                      <th colspan="{{ count($pembelajarans) }}" class="text-center bg-warning">NILAI</th>
                      <th rowspan="2">TOTAL NILAI</th>
                      <th rowspan="2">RATA-RATA</th>
                      <th rowspan="2">RANKING</th>
                    </tr>
                    <tr class="bg-primary">
                      @foreach($pembelajarans as $pembelajaran)
                          <th>{{ $pembelajaran->mapel->singkatan }}</th>
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($nilaiSiswa as $siswa)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $siswa['siswa']->nis }}</td>
                          <td>{{ $siswa['siswa']->name }}</td>
                          <td>{{ $siswa['siswa']->jk }}</td>
                          @foreach($pembelajarans as $pembelajaran)
                              <td>{{ $siswa[$pembelajaran->id] }}</td>
                          @endforeach
                          <td>{{ $siswa['totalNilai'] }}</td>
                          <td>{{ $siswa['rataRata'] }}</td>
                          <td>{{ $siswa['peringkat'] }}</td>
                      </tr>
                    @endforeach
                  </tbody>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs4/jq-3.7.0/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/kt-2.11.0/datatables.min.js"></script>

 <script>
  $(document).ready(function(){
    $('#myTable').DataTable({
      paginate: false,
      ordering: true,
      // searching: false,
      dom: 'Bfrtip',
        buttons: [
            // 'copy',
            // 'csv',
            'excel',
            'pdf',
            // 'print',
        ]
    });
  })
 </script>
@endsection
