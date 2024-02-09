<input type="hidden" name="siswa_id[]" id="siswa_id-{{ $data->id }}" value="{{ $data->id }}">
<input type="number" class="form-control nilaiakhir-input" name="nilai-{{ $data->id }}" id="nilai-{{ $data->id }}" value="{{ $nilaiSiswa }}" oninput="validateInputNilai(this)">
