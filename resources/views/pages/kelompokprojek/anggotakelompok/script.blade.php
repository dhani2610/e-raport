<script>
  $(document).ready(function(){
    $('#myTableShow').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      ajax: {
        url: '/anggotakelompok/{{ $kelompokprojek->id }}',
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'nis', name: 'nis'},
        {data: 'name', name: 'name'},
        {data: 'jk', name: 'jk'},
        {data: 'delete', name: 'delete'},
      ]
    });

    $('#myTableCreate').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      ajax: {
        url: '{{ route('anggotakelompok.create') }}',
        data: function(d) {
          d.kelompok_projek_id = '{{ $kelompokprojek->id }}';
        }
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'nis', name: 'nis'},
        {data: 'name', name: 'name'},
        {data: 'jk', name: 'jk'},
        {data: 'add', name: 'add'},
      ]
    });

    // SETUP CSRF
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // CREATE
    $('body').on('click', '.create-button', function(e) {
        $('#modal-create').modal('show');
    });

    // STORE
    $('body').on('click', '.anggotakelompok-store-button', function(e) {
      var id = $(this).data('id');
        showLoaderAtShow();
        $.ajax({
            url: '/anggotakelompok',
            type: 'POST',
            data: {
              kelompok_projek_id: '{{ $kelompokprojek->id }}',
              siswa_id: id,
            },
            success: function(response) {
              hideLoaderAtShow();
              if (response.success) {
                successToast(response.success)
                $('#myTableCreate').DataTable().ajax.reload();
                $('#myTableShow').DataTable().ajax.reload();
              } else{
                $('#modal-create').modal('hide');
                warningToast('Terjadi kesalahan!');
              }
            }
        });
    });

    // DELETE
    $('body').on('click', '.anggotakelompok-delete-button', function(e) {
        var id = $(this).data('id');
          showLoaderAtShow();
          $.ajax({
              url: '/anggotakelompok/' + id,
              type: 'DELETE',
              success: function(response) {
                hideLoaderAtShow();
                if (response.success) {
                  successToast('Berhasil dihapus!');
                  $('#myTableCreate').DataTable().ajax.reload();
                  $('#myTableShow').DataTable().ajax.reload();
                } else {
                  warningToast('Terjadi kesalahan!');
                }
              }
          });
      });

  });
</script>
