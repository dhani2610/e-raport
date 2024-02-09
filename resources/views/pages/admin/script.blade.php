<script>
  $(document).ready(function(){
    $('#myTable').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      ajax: {
        url: '{{ route('admin.index') }}',
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'name', name: 'name'},
        {data: 'jk', name: 'jk'},
        {data: 'nip', name: 'nip'},
        {data: 'nuptk', name: 'nuptk'},
        {data: 'user.is_aktif', name: 'user.is_aktif'},
        {data: 'aksi', name: 'aksi'},
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
        url: '/admin/' + id,
        type: 'GET',
        success: function(response){
          hideLoader();
          $('#modal-show').modal('show');
          $.each(response.result, function(field, value){
            if (field == 'jk') value = (value == 'L') ? 'LAKI-LAKI' : 'PEREMPUAN'; // Jenis Kelamin
            $('#show-' + field).html(value); // Loop Semua Data
          });

          $('#show-edit-route').data('id', response.result.id);
          $('#show-user-foto').attr('src', '/img/fotoprofil/'+response.result.user.foto);
          $('#show-user-is_aktif').addClass(response.result.user.is_aktif == 1 ? 'bg-success' : 'bg-danger').html(response.result.user.is_aktif == 1 ? 'AKTIF' : 'NON-AKTIF');

          var tgllahir = response.result.tanggallahir.split('-')[2] + '-' + response.result.tanggallahir.split('-')[1] + '-' + response.result.tanggallahir.split('-')[0]
          $('#show-ttl').html(response.result.tempatlahir + ', ' + tgllahir);
        }
      });
    });

    // EDIT
    $('body').on('click', '.edit-button', function() {
      window.location.href = "admin/" + $(this).data('id') + '/edit';
    });

    // DELETE
    $('body').on('click', '.delete-button', function(e) {
    showLoader();
    var id = $(this).data('id');

      $.ajax({
          url: '/admin/' + id + '/get-name',
          type: 'GET',
          success: function(response) {
              hideLoader();
              console.log(response.name);
              $('#modal-delete').modal('show');
              $('#delete-admin-name').html(response.name);

              $('#confirm-delete-button').off('click').click(function() {
                $('#modal-delete').modal('hide');
                showLoader();
                  $.ajax({
                      url: '/admin/' + id,
                      type: 'DELETE',
                      success: function(response) {
                        hideLoader();
                        toast(response.success);
                        $('#myTable').DataTable().ajax.reload();
                      }
                  });
              });
          }
      });

    });

  });

  function toast(success){
    $(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'BERHASIL',
        body: success
      })
    });
    setTimeout(function() {
      $(".toast").fadeOut(500, function() {
        $(this).remove();
      });
    }, 4000);
  }

  $('#modal-show').on('hidden.bs.modal', function() {
    $('.show_value').html('');
    $('#show-user-is_aktif').removeClass(['bg-danger', 'bg-success']);
  });
</script>
