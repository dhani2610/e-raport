<input type="hidden" name="id[]" id="{{ $data->id }}" value="{{ $data->id }}">
<textarea name="keterangan[]" class="form-control edit-field" id="keterangan{{ $data->id }}" cols="30" rows="2" oninput="checkLength(this, {{ $data->id }})">{{ $data->keterangan }}</textarea>
<small class="text-danger" id="error-edit-keterangan{{ $data->id }}"></small>
