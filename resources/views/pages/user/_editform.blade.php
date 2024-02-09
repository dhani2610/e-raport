<div class="form-group row">
  <label for="name" class="col-sm-2 col-form-label">Nama @include('partials._wajib')</label>
  <div class="col-sm-10">
    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Ketik Nama" required>
    @error('name') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div>
</div>
<div class="form-group row">
  <label for="role" class="col-sm-2 col-form-label">Role @include('partials._wajib')</label>
  <div class="col-sm-10">
    <select name="role" id="role" class="form-control selectTwo @error('role') is-invalid @enderror" data-width="100%" required>
      <option disabled selected hidden>-- Pilih --</option>
      <option value="opt1" {{ old('role', $user->abc) == 'opt1' ? 'selected' : '' }}>Option 1</option>
      <option value="opt2" {{ old('role', $user->abc) == 'opt2' ? 'selected' : '' }}>Option 2</option>
    </select>
    @error('role') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div>
</div>
<div class="form-group row">
  <label for="alamat" class="col-sm-2 col-form-label">Alamat @include('partials._wajib')</label>
  <div class="col-sm-10">
    <textarea type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Ketik Alamat" required>{{ old('alamat', $user->abc) }}</textarea>
    @error('alamat') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div>
</div>
<div class="form-group row">
  <label for="email" class="col-sm-2 col-form-label">Email @include('partials._wajib')</label>
  <div class="col-sm-10">
    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Ketik Email" required>
    @error('email') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div>
</div>
<div class="form-group row">
  <div class="input-group">
  <label for="password" class="col-sm-2 col-form-label">Password Baru <small>(Opsional)</small></label>
    <div class="col-sm-10 input-group mb-3">
      <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Ketik Password">
      <div class="input-group-append" onclick="togglePassword()">
        <span class="input-group-text" style="cursor: pointer;"><i class="fa fa-eye-slash" id="eye-icon"></i></span>
      </div>
      @error('password') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
</div>

<script>
  function togglePassword() {
    var x = document.getElementById('password');
    var y = document.getElementById('eye-icon');
    if (x.type === 'password') {
      x.type = 'text';
      y.classList.add('fa-eye');
      y.classList.remove('fa-eye-slash');
      y.classList.add('text-primary');
    } else {
      x.type = 'password';
      y.classList.add('fa-eye-slash');
      y.classList.remove('text-primary');
      y.classList.remove('fa-eye');
    }
  }
</script>
