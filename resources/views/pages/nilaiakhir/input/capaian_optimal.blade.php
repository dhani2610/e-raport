@foreach ($tp as $item)
  <div class="form-check">
    <input class="form-check-input" value="{{ $item->id }}" name="optimal-{{ $data->id }}[]" id="optimal-{{ $data->id }}-{{ $item->id }}" type="checkbox" {{ $data->pencapaianTp->where('tujuan_pembelajaran_id', $item->id)->where('status_capaian', 'optimal')->first() ? 'checked' : ''  }}>
    <label for="optimal-{{ $data->id }}-{{ $item->id }}" class="form-check-label">{{ $item->keterangan }}</label>
  </div>
@endforeach
