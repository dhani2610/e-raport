<div class="btn-group">
  @can('pembinaekskul')
  <button data-id="{{ $data->id }}" class="show-button btn btn-success btn-sm mx-1">
      <i class="fas fa-eye"></i>
      Kelola
  </button>
  @else
  <button data-id="{{ $data->id }}" class="edit-button btn btn-warning btn-sm mx-1">
      <i class="fas fa-pencil-alt"></i>
      Edit
  </button>
  <button data-id="{{ $data->id }}" data-name="{{ $data->name }}" class="delete-button btn btn-danger btn-sm mx-1">
      <i class="fas fa-trash">
      </i>
      Hapus
  </button>
  @endcan
</div>
