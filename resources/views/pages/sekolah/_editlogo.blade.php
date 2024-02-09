<div class="table-responsive">
  <table class="table table-border table-hover mt-xs-2">
      <tr class="text-center table-secondary">
        <td>Logo</td>
      </tr>
      <tr>
        <td class="text-center"><img src="/img/{{ $sekolah->logo }}" alt="" style="width: 120px" class="img-preview"></td>
      </tr>
  </table>
</div>

<small class="fs-12"> <i>Ganti logo sekolah</i></small>
<form action="{{ url('/sekolah/updatelogo') }}" method="POST" enctype="multipart/form-data" id="form-update-logo">
    @csrf
    @method('PUT')

    <input type="hidden" name="old_logo" id="" value="{{ $sekolah->logo }}" hidden>

    <div class="">
      <div class="input-group mb-3">
        <input type="file" accept="image/*" class="form-control logo-field" name="logo" id="gambar" onchange="previewImage()">
        <button type="submit" class=" btn btn-primary" for="inputGroupFile02" id="logo-update-button">Update</button>
        <span class="invalid-feedback mt-1" id="error-logo"></span>
      </div>
    </div>

</form>
