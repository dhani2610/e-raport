<script>
  $(document).ready(function(){

    // INDEX TABLE
    $('#myTableShow').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      ajax: {
        url: '/tujuanpembelajaran/{{ $pembelajaran->id }}',
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'keterangan', name: 'keterangan'},
        {data: 'aksi', name: 'aksi'},
      ]
    });

    // SETUP CSRF
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // CREATE
    $('body').on('click', '#create-button', function(e) {
      e.preventDefault();
      $('#modal-create').modal('show');

      $('#form-store-tp').on('submit', function(e){
        e.preventDefault();
        showLoaderAtShow();

        $.ajax({
          url: '{{ route('tujuanpembelajaran.store') }}',
          type: 'POST',
          data: new FormData(this),
          contentType: false,
          processData: false,

          success:function(response){
            if (response.failed){
              hideLoaderAtShow();
              failedToast(response.failed);
            } else {
              console.log(response.req);
              // $('#myTableShow').DataTable().ajax.reload();
              $('#modal-create').modal('hide');
              // scrollToTop();
              // resetInputTP();
              location.reload();
              successToast(response.success);
            }
          }

        });
      });
    });

    // UPDATE
    $('#form-update-tp').on('submit', function(e){
      e.preventDefault();
      if (document.getElementById('update-confirm').checked) {
        showLoader();
        $.ajax({
          url: '/tujuanpembelajaran/{{ $pembelajaran->id }}',
          type: 'POST',
          data: new FormData(this),
          contentType: false,
          processData: false,

          success:function(response){
            hideLoader();
            if (response.failed){
              failedToast(response.failed);
            } else {
              $('#myTableShow').DataTable().ajax.reload();
              scrollToTop();
              successToast(response.success);
            }
          }

        })
      } else {
        warningToast('Harap centang konfirmasi perubahan terlebih dahulu!');
      }
    });

     // DELETE
     $('body').on('click', '.tp-delete-button', function(e) {
      var id = $(this).data('id');
      var keterangan = $(this).data('keterangan');

      $('#modal-delete').modal('show');
      $('#delete-tp-keterangan').html(keterangan);

      $('#confirm-delete-button').off('click').click(function() {
        $('#modal-delete').modal('hide');
        showLoaderAtShow();
          $.ajax({
              url: '/tujuanpembelajaran/delete/' + id,
              type: 'DELETE',
              success: function(response) {
                hideLoaderAtShow();
                if (response.failed) {
                  failedToast(response.failed)
                } else {
                  successToast(response.success);
                  $('#myTableShow').DataTable().ajax.reload();
                }
              }
          });
      });
    });

  });
</script>
