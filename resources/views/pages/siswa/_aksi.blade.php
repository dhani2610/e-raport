<div class="btn-group">
  <button class="show-button btn btn-success btn-sm mx-1" data-id="{{ $data->id }}" data-toggle="tooltip" data-placement="top" title="Show">
      <i class="fas fa-eye">
      </i>
      Detail
  </button>
  <button data-id="{{ $data->id }}" class="edit-button btn btn-warning btn-sm mx-1"  data-toggle="tooltip" data-placement="top" title="Edit">
      <i class="fas fa-pencil-alt">
      </i>
      Edit
  </button>
  <button data-id="{{ $data->id }}" class="delete-button btn btn-danger btn-sm mx-1" data-placement="top" title="Delete">
      <i class="fas fa-trash">
      </i>
      Hapus
  </button>
</div>
