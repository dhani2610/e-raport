<script>
  $(document).ready(function(){
    $('#myTableShow').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      ajax: {
        url: '/capaianprojek/{{ $projek->id }}',
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'fase', name: 'fase'},
        {data: 'dimensi', name: 'dimensi'},
        {data: 'elemen', name: 'elemen'},
        {data: 'subelemen', name: 'subelemen'},
        {data: 'delete', name: 'delete'},
      ]
    });

    $('#myTableCreate').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      ajax: {
        url: '{{ route('capaianprojek.create') }}',
        data: function(d) {
          d.projek_id= '{{ $projek->id }}';
        }
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'fase', name: 'fase'},
        {data: 'dimensi', name: 'dimensi'},
        {data: 'elemen', name: 'elemen'},
        {data: 'subelemen', name: 'subelemen'},
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
    $('body').on('click', '.capaianprojek-store-button', function(e) {
      var id = $(this).data('id');
        showLoaderAtShow();
        $.ajax({
            url: '/capaianprojek',
            type: 'POST',
            data: {
              projek_id: '{{ $projek->id }}',
              capaian_akhir_id: id,
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
    $('body').on('click', '.capaianprojek-delete-button', function(e) {
        var id = $(this).data('id');
          showLoaderAtShow();
          $.ajax({
              url: '/capaianprojek/' + id,
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
