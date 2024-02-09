@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">Data User</h4>
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
            <a href="{{ route('user.create') }}" class="btn btn-sm float-left btn-primary btn-icon-split">
              <i class="fa fa-plus"></i>
              Tambah User
            </a>
            <button class="btn btn-sm float-right btn-info btn-icon-split" data-toggle="modal" data-target="#modal-filter">
              <i class="fa fa-filter me-2"></i>
              Filter Data
            </button>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if ($user->count() < 1)
              Data masih kosong!
            @else
              <div class="table-responsive">
                <table id="myTable" class="table table-sm table-hover fs-14 mb-0">
                  <thead>
                  <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                    <th scope="col">No.</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Aksi</th>
                  </tr>
                  </thead>
                  <tbody>

                      @foreach ($user as $item)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->name }}</td>
                          <td>{{ $item->email }}</td>
                          <td>{{ $item->username }}</td>
                          <td class="project-actions">
                            <div class="btn-group">
                              <a class="btn btn-success btn-sm mx-1" href="{{ route('user.show', $item) }}" data-toggle="tooltip" data-placement="top" title="Show">
                                  <i class="fas fa-eye">
                                  </i>
                                  Show
                              </a>
                              <a class="btn btn-warning btn-sm mx-1" href="{{ route('user.edit', $item) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                  <i class="fas fa-pencil-alt">
                                  </i>
                                  Edit
                              </a>
                              <button type="button" class="btn btn-danger btn-sm mx-1" data-toggle="modal" data-target="#modalDelete{{ $item->id }}" data-placement="top" title="Delete">
                                  <i class="fas fa-trash">
                                  </i>
                                  Delete
                              </button>
                              <div class="modal fade text-left" id="modalDelete{{ $item->id }}">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title fw-bold" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                        Data User:
                                        <p class="text-primary fw-bold">{{ $item->name }}</p>
                                        Apakah anda yakin data tersebut akan dihapus?
                                      </div>
                                      <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                                        <form action="{{ route('user.destroy', $item) }}" method="POST" class="d-inline float-end">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                      </div>
                                  </div>
                              </div>
                              </div>
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

@include('pages.user._filter')

@endsection
<script>
  $(document).ready(function(){
    $('#myTable').DataTable();
  });
</script>
@section('js')

@endsection
