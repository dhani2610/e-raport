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
          Tujuan Pembelajaran
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
        <form action="{{ route('tujuanpembelajaran.update', $pembelajaran->id) }}" method="POST" id="form-update-tp">
        @csrf
        @method('PUT')
          <div class="card">
            <div class="card-header">
              <div class="callout callout-warning my-1">
                <div class="col-md-6">
                  <table class="table table-sm no-border">
                    <tr>
                      <td class="fw-bold">Mata Pelajaran</td>
                      <td style="width: 1px;" class="px-2">:</td>
                      <td>{{ $pembelajaran->mapel->name }}</td>
                    </tr>
                    <tr>
                      <td class="fw-bold">Kelas</td>
                      <td style="width: 1px;" class="px-2">:</td>
                      <td>{{ $pembelajaran->kelas->name }}</td>
                    </tr>
                    <tr>
                      <td class="fw-bold">Guru Pengampu</td>
                      <td style="width: 1px;" class="px-2">:</td>
                      <td>{{ $pembelajaran->guru_pengampu() }}</td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="mt-3">
                <button type="button" class="btn btn-success btn-sm float-left" id="create-button">
                  <i class="fas fa-plus"></i>
                  Tambah Tujuan Pembelajaran
                </button>
                <a href="/nilaiakhir/{{$pembelajaran->id }}" class="show-projekpilihan-button btn btn-warning btn-sm mx-1 float-right">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                  </svg>
                  Nilai
                </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if ($tujuanpembelajaran->count() < 1)
                Data masih kosong!
              @else
                <div class="table-responsive">
                  <table id="myTableShow" class="table table-sm table-hover mb-0">
                    <thead>
                      <tr class="bg-dark text-white header-table {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                        <th scope="col" style="width: 20px">No.</th>
                        <th scope="col">Tujuan Pembelajaran (Maksimal 150 karakter)</th>
                        <th scope="col" style="width: 50px">Hapus</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              @endif
            </div>
            @if ($tujuanpembelajaran->count() >= 1)
              <div class="card-footer">
                <div class="form-check d-inline">
                  <input type="hidden" name="pembelajaran_id" id="pembelajaran_id" value="{{ $pembelajaran->id }}">
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

@include('pages.tujuanpembelajaran.kelola._delete')
@include('pages.tujuanpembelajaran.kelola._create')

@endsection

@section('js')
 @include('partials.toast2')

 <script>
  function checkLength(textarea, id) {
      var textLength = textarea.value.length;
      var maxLength = 150;

      if (textLength > maxLength) {
          textarea.value = textarea.value.slice(0, maxLength);
          document.getElementById("error-edit-keterangan" + id).innerHTML = "Maksimal 150 karakter";
      } else {
          document.getElementById("error-edit-keterangan" + id).innerHTML = "";
      }
  }

  // Fungsi untuk memeriksa panjang teks pada textarea
  function limitInputTP(textarea, errorElement) {
      var maxLength = 150;

      if (textarea.value.length > maxLength) {
          // Jika panjang teks melebihi batas, potong teks menjadi maksimal 150 karakter
          textarea.value = textarea.value.slice(0, maxLength);

          // Tampilkan pesan kesalahan
          errorElement.innerHTML = "Maksimal 150 karakter";
      } else {
          // Jika tidak melebihi batas, hapus pesan kesalahan
          errorElement.innerHTML = "";
      }
  }
</script>

<script>
  document.getElementById('duplikat-keterangan').addEventListener('click', function() {
      document.getElementById('reset').classList.remove('d-none');

      // Buat elemen baru untuk menyalin textarea
      var newTextArea = document.createElement('textarea');
      newTextArea.className = 'form-control create-keterangan';
      newTextArea.name = 'keterangan[]';
      newTextArea.rows = '3';
      newTextArea.placeholder = 'Ketik Tujuan Pembelajaran';
      newTextArea.value = '';

      // Buat elemen div untuk memberikan jarak
      var spacerDiv = document.createElement('div');
      spacerDiv.style.marginBottom = '15px'; // Sesuaikan jarak sesuai kebutuhan

      // Temukan elemen dengan id 'duplikat' dan tambahkan elemen baru dan spacerDiv ke dalamnya
      var duplikatElement = document.getElementById('duplikat');
      duplikatElement.appendChild(newTextArea);
      duplikatElement.appendChild(spacerDiv);

  });
  // Tambahkan event listener untuk tombol "Hapus Elemen Duplikat"
  document.getElementById('reset').addEventListener('click', function() {
    resetInputTP();
    document.getElementById('reset').classList.add('d-none');
  });

  function resetInputTP(){
    var duplikatElement = document.getElementById('duplikat');
    while (duplikatElement.firstChild) {
        duplikatElement.removeChild(duplikatElement.firstChild);
    }
    var element = document.querySelector('.create-keterangan');
    if (element) {
      element.value = null;
    }
  }
</script>

@include('pages.tujuanpembelajaran.kelola._scriptshow')

@endsection
