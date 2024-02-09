<script>
  $(document).ready(function(){
    $('#myTableShow').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      ajax: {
        url: '/projekpilihankelompok/{{ $kelompokprojek->id }}',
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'fase.name', name: 'fase.name'},
        {data: 'tema', name: 'tema'},
        {data: 'name', name: 'name'},
        {data: 'deskripsi', name: 'deskripsi'},
        {data: 'delete', name: 'delete'},
      ]
    });

    $('#myTableCreate').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      ajax: {
        url: '{{ route('projekpilihankelompok.create') }}',
        data: function(d) {
          d.kelompok_projek_id = '{{ $kelompokprojek->id }}';
        }
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'fase.name', name: 'fase.name'},
        {data: 'tema', name: 'tema'},
        {data: 'name', name: 'name'},
        {data: 'deskripsi', name: 'deskripsi'},
        {data: 'add', name: 'add'},
      ]
    });

    // SETUP CSRF
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // SHOW
    $('body').on('click', '.show-button', function(e){
      showLoader();
      var id = $(this).data('id');
        $.ajax({
          url: '/projekpilihankelompok/' + id + '/edit',
          type: 'GET',
          success: function(response){
            hideLoader();
            $.each(response.result, function(field, value){
              $('#show-' + field).html(value); // Loop Semua Data
            });
            $('#modal-show').modal('show');
            $('#show-fase-name').html(response.result.fase.name);
            $('#show-jumlah-capaianprojek').html(response.result.capaian_projek.length);
          }
        });
    });

    // KELOLA NILAI
    $('body').on('click', '.kelola-nilai-button', function(e){
      loadAMoment();
      window.location.href = '/projekpilihankelompok/nilai/' + $(this).data('id');
    });

    // KELOLA NILAI
    $('body').on('click', '.kelola-catatan-button', function(e){
      loadAMoment();
      window.location.href = '/projekpilihankelompok/catatan/' + $(this).data('id');
    });

    // CREATE
    $('body').on('click', '.create-button', function(e) {
        $('#modal-create').modal('show');
    });

    // STORE
    $('body').on('click', '.projekpilihankelompok-store-button', function(e) {
      var id = $(this).data('id');
        showLoaderAtShow();
        $.ajax({
            url: '/projekpilihankelompok',
            type: 'POST',
            data: {
              kelompok_projek_id: '{{ $kelompokprojek->id }}',
              projek_id: id,
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
    $('body').on('click', '.projekpilihankelompok-delete-button', function(e) {
        var id = $(this).data('id');
          showLoaderAtShow();
          $.ajax({
              url: '/projekpilihankelompok/' + id,
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
