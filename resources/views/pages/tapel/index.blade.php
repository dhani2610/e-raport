@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">Data Tahun Pelajaran</h4>
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
          @can('admin')
          <div class="card-header">
            <a href="{{ route('tapel.create') }}" class="btn btn-sm float-left btn-primary btn-icon-split ">
              <i class="fa fa-plus"></i>
              Tambah Tahun Pelajaran
            </a>
          </div>
          @endcan
          <!-- /.card-header -->
          <div class="card-body">
            @if ($tapel->count() < 1)
              Data masih kosong!
            @else
              <div class="table-responsive">
                <table id="myTable" class="table table-sm table-hover mb-0">
                  <thead>
                    <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                      <th scope="col">No.</th>
                      <th scope="col">Tahun Pelajaran</th>
                      <th scope="col">Semester</th>
                      <th scope="col">Tempat Pembagian Raport</th>
                      <th scope="col">Tanggal Pembagian Raport</th>
                      <th scope="col">Status</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tapel as $item)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tahun_pelajaran }}</td>
                        <td>{{ $item->semester() }}</td>
                        <td>{{ $item->tempat ?? '-'}}</td>
                        <td>{{ $item->tanggal() }}</td>
                        <td>
                            @if ($item->status == 1)
                              <span class="badge badge-success">Aktif</span>
                            @else
                              <span class="badge badge-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                          <div class="btn-group">
                            <a href="{{ route('tapel.edit', $item) }}" class="edit-button btn btn-warning btn-sm mx-1">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                          </div>
                        </td>
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

{{-- @include('pages.tapel._show') --}}
{{-- @include('pages.tapel._delete') --}}

@endsection

@section('js')
  <script>
    $(document).ready(function(){
      $('#myTable').dataTable({
        paginate: false,
        searching: false,
        ordering: false,
      });
    });
  </script>
@endsection
