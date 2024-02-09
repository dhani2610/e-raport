@extends('layouts.main')

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
          Data User</h4>
      </div>
    </div>
  </div>
</div>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header align-items-center">
            <h3 class="card-title pt-1">Detail Data User</h3>
            <div class="float-right">
              <a href="{{ route('user.edit', $user) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-pencil-alt pe-1">
                </i>
                Edit Data
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                   src="/img/profile.jpg"
                   alt="User profile picture">
            </div>

            <h3 class="profile-username text-center mb-5">{{ $user->name }}</h3>

            <div class="table-responsive">
              <table class="table table-sm table-hover">
                  <tr class="">
                    <td class="fw-bold">Status Akun</td>
                    <td style="width: 1px;">:</td>
                    <td class="">
                      <span class="badge bg-success">
                        AKTIF
                      </span>
                    </td>
                  </tr>
                  <tr class="">
                    <td class="fw-bold">Email</td>
                    <td style="width: 1px;">:</td>
                    <td class="">{{ $user->email ?? '-' }}</td>
                  </tr>
                  <tr class="">
                    <td class="fw-bold">Username</td>
                    <td style="width: 1px;">:</td>
                    <td class="">{{ $user->username ?? '-' }}</td>
                  </tr>
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
