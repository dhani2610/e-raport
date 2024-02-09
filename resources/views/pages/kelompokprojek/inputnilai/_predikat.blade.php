<input type="hidden" name="siswa_id[]" value="{{ $id }}" id="siswa-{{ $id }}">
<select name="predikat[]" id="predikat-{{ $id }}" class="form form-control predikat-siswa">
  <option value="" {{ $predikat == '' ? 'selected' : '' }}></option>
  <option value="MB" {{ $predikat == 'MB' ? 'selected' : '' }}>Mulai Berkembang</option>
  <option value="SDGB" {{ $predikat == 'SDGB' ? 'selected' : '' }}>Sedang Berkembang</option>
  <option value="BSH" {{ $predikat == 'BSH' ? 'selected' : '' }}>Berkembang Sesuai Harapan</option>
  <option value="SGTB" {{ $predikat == 'SGTB' ? 'selected' : '' }}>Sangat Berkembang</option>
</select>
