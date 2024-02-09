<select name="predikat[]" id="predikat{{ $id }}" class="form form-control">
  <option value="" {{ $predikat == '' ? 'selected' : '' }}>-- Pilih --</option>
  <option value="A" {{ $predikat == 'A' ? 'selected' : '' }}>Sangat Baik</option>
  <option value="B" {{ $predikat == 'B' ? 'selected' : '' }}>Baik</option>
  <option value="C" {{ $predikat == 'C' ? 'selected' : '' }}>Cukup</option>
  <option value="D" {{ $predikat == 'D' ? 'selected' : '' }}>Kurang</option>
</select>
