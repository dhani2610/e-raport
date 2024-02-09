@foreach ($tp as $item)
  <div class="form-check">
    <input class="form-check-input" value="{{ $item->id }}" name="kurang-{{ $data->id }}[]" id="kurang-{{ $data->id }}-{{ $item->id }}" type="checkbox" {{ $data->pencapaianTp->where('tujuan_pembelajaran_id', $item->id)->where('status_capaian', 'kurang')->first() ? 'checked' : ''  }}>
    <label for="kurang-{{ $data->id }}-{{ $item->id }}" class="form-check-label">{{ $item->keterangan }}</label>
  </div>
@endforeach
