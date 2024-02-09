<div class="btn-group">
  @can('gurumapel')
    <button data-id="{{ $data->id }}" class="tp-button btn btn-info btn-sm mx-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right-circle-fill" viewBox="0 0 16 16">
          <path d="M0 8a8 8 0 1 0 16 0A8 8 0 0 0 0 8zm5.904 2.803a.5.5 0 1 1-.707-.707L9.293 6H6.525a.5.5 0 1 1 0-1H10.5a.5.5 0 0 1 .5.5v3.975a.5.5 0 0 1-1 0V6.707l-4.096 4.096z"/>
        </svg>
        Kelola Tujuan Pembelajaran
    </button>
    <button data-id="{{ $data->id }}" class="nilai-button btn btn-primary btn-sm mx-1">
        <i class="fas fa-pencil-alt"></i>
        Input Nilai dan Deskripsi
    </button>
  @else
    <button data-id="{{ $data->id }}" class="edit-button btn btn-warning btn-sm mx-1">
        <i class="fas fa-pencil-alt"></i>
        Edit
    </button>
    <button data-id="{{ $data->id }}" data-name="{{ $data->mapel->name }} - {{ $data->kelas->name }}" class="delete-button btn btn-danger btn-sm mx-1">
        <i class="fas fa-trash">
        </i>
        Hapus
    </button>
  @endcan
</div>
