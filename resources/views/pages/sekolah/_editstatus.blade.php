
<form action="{{ route('updatestatus',$sekolah->id) }}" method="POST" enctype="multipart/form-data" id="form-update-logo">
    @csrf

    <div class="">
      <div class="input-group mb-3">
        <select name="status" id="" class="form-control">
          <option value="1" {{ $sekolah->status == '1' ? 'selected' : '' }} >Aktif</option>
          <option value="2" {{ $sekolah->status == '2' ? 'selected' : '' }} >Tidak Aktif</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
    </div>

</form>
