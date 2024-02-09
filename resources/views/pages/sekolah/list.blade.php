@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">Data Sekolah</h4>
      </div>
    </div>
  </div>
</div>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}
        </div>
    @endif

    <div class="row">
      <div class="col">
        <div class="card">
          @can('admin')
          <div class="card-header">
            <a href="{{ route('create-sekolah') }}" class="btn btn-sm float-left btn-primary btn-icon-split create-button">
              <i class="fa fa-plus"></i>
              Tambah Sekolah
            </a>
          </div>
          @endcan
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="myTable" class="table table-sm table-hover mb-0">
                <thead>
                <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                  <th scope="col">No.</th>
                  <th scope="col" class="mw-100">Logo</th>
                  <th scope="col" class="mw-100">Nama Sekolah</th>
                  <th scope="col">NSS</th>
                  <th scope="col">NPSN</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Kode POS</th>
                  <th scope="col">Telepon</th>
                  <th scope="col">Email</th>
                  <th scope="col">Website</th>
                  <th scope="col">Kepala Sekolah</th>
                  <th scope="col">NIP Kepala Sekolah</th>
                  <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($sekolah as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('img/'.$item->logo) }}" style="width: 120px" alt="">
                            </td>
                            <td>{{ $item->name }} </td>
                            <td>{{ $item->nss }} </td>
                            <td>{{ $item->npsn }} </td>
                            <td>{{ $item->alamat }} </td>
                            <td>{{ $item->kodepos }} </td>
                            <td>{{ $item->telepon }} </td>
                            <td>{{ $item->email }} </td>
                            <td>{{ $item->website }} </td>
                            <td>{{ $item->namakepsek }} </td>
                            <td>{{ $item->nipkepsek }} </td>
                            <td>
                                <a href="{{ route('edit-sekolah',$item->id) }}" class="edit-button btn btn-warning btn-sm mx-1">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                                </a>
                                <a href="{{ route('delete-sekolah',$item->id) }}" class="delete-button btn btn-danger btn-sm mx-1">
                                <i class="fas fa-trash"> </i>
                                Hapus
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
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
    $('#myTable').dataTable();
</script>
 {{-- @include('pages.kelas.script') --}}
@endsection
