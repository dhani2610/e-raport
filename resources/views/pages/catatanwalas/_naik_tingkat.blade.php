<select name="naik_tingkat[]" id="naik_tingkat{{ $id }}" class="form form-control">
  {{-- <option value="" {{ $naik_tingkat == '' ? 'selected' : '' }}>-- Pilih --</option> --}}
  @foreach ($naikTingkat as $item)
    <option value="{{ $item['value'] }}" {{ $item['value'] == $naik_tingkat ? 'selected' : '' }}>{{ $item['key'] }}</option>
  @endforeach
</select>
