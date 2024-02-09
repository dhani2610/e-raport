<script>
  $(document).ready(function(){
    $('#myTable').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      ajax: {
        url: '{{ route('ekskul.index') }}',
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'name', name: 'name'},
        {data: 'guru.name', name: 'guru.name'},
        {data: 'anggotaEkskul.count', name: 'anggotaEkskul.count'},
        {data: 'aksi', name: 'aksi'},
      ]
    });

    // SETUP CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // CREATE AND STORE
    $('body').on('click', '.create-button', function(e) {
        e.preventDefault();
        $('#modal-create').modal('show');

        $('#form-create').on('submit', function(a){
          a.preventDefault();
          if (document.getElementById('store-confirm').checked) {
            $('#create-confirm-alert').addClass('d-none');
            $('#create-confirm-alert').removeClass('show');
            showLoaderAtShow();
            $.ajax({
              url: '/ekskul',
              type: 'POST',
              data: new FormData(this),
              contentType: false,
              processData: false,

              success:function(response){
                hideLoaderAtShow();
                if (response.errors){
                  $('.create-field').removeClass('is-invalid');
                  $('.create-field').addClass('is-valid');
                  $('.invalid-feedback').html('');

                  $.each(response.errors, function(field, errors) {
                      $('#create-' + field).removeClass('is-valid');
                      $('#create-' + field).addClass('is-invalid');
                      $('#error-create-' + field).html(errors[0]);
                  });
                } else if (response.failed){
                  $('#modal-create').modal('hide');
                  $('.create-field').removeClass('is-invalid');
                  $('.create-field').removeClass('is-valid');
                  $('.invalid-feedback').html('');
                  failedToast(response.failed);
                } else {
                  $('#modal-create').modal('hide');
                  $('.create-field').removeClass('is-invalid');
                  $('.create-field').removeClass('is-valid');
                  $('.invalid-feedback').html('');
                  $('#myTable').DataTable().ajax.reload();
                  successToast(response.success);
                }
              }

            });
          } else {
            $('#create-confirm-alert').addClass('show');
            $('#create-confirm-alert').removeClass('d-none');
          }
        });

    });

    // EDIT
    $('body').on('click', '.edit-button', function(e) {
        showLoader();
        var id = $(this).data('id');
        $.ajax({
          url: 'ekskul/' + id + '/edit',
          type: 'GET',
          success: function(response){
            hideLoader();
            $('#modal-edit').modal('show');

            $.each(response.dataEdit, function(field, value) {
              $('#edit-' + field).val(value);
            });

            $('#form-edit').on('submit', function(a){
              a.preventDefault();
              if (document.getElementById('update-confirm').checked) {
                $('#edit-confirm-alert').addClass('d-none');
                $('#edit-confirm-alert').removeClass('show');
                showLoaderAtShow();

                // UPDATE
                $.ajax({
                  url: '/ekskul/' + id,
                  type: 'PUT',
                  data: {
                      name: $('#edit-name').val(),
                      guru_id: $('#edit-guru_id').val(),
                      tapel_id: $('#edit-tapel_id').val(),
                  },

                  success: function(response){
                    hideLoaderAtShow();
                    if (response.errors) {
                      $('.edit-field').removeClass('is-invalid');
                      $('.edit-field').addClass('is-valid');
                      $('.invalid-feedback').html('');

                      $.each(response.errors, function(field, errors) {
                          $('#edit-' + field).removeClass('is-valid');
                          $('#edit-' + field).addClass('is-invalid');
                          $('#error-edit-' + field).html(errors[0]);
                      });

                    } else if(response.failed){
                      $('#modal-edit').modal('hide');
                      failedToast(response.failed);

                    } else {
                      successToast(response.success);
                      $('#modal-edit').modal('hide');
                    }
                    $('#myTable').DataTable().ajax.reload();
                  }
                });

              } else {
                $('#edit-confirm-alert').addClass('show');
                $('#edit-confirm-alert').removeClass('d-none');
              }
            });
          }
        })
    });

    // DELETE
    $('body').on('click', '.delete-button', function(e) {
    var id = $(this).data('id');
    var name = $(this).data('name');

    $('#modal-delete').modal('show');
    $('#delete-ekskul-name').html(name);

    $('#confirm-delete-button').off('click').click(function() {
      $('#modal-delete').modal('hide');
      showLoaderAtShow();
        $.ajax({
            url: '/ekskul/' + id,
            type: 'DELETE',
            success: function(response) {
              hideLoaderAtShow();
              toast(response.success);
              $('#myTable').DataTable().ajax.reload();
            }
        });
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

  function failedToast(failed){
    $(function() {
      $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'GAGAL',
        body: failed
      })
    });
    setTimeout(function() {
      $(".toast").fadeOut(500, function() {
        $(this).remove();
      });
    }, 4000);
  }

  $('#modal-create').on('hidden.bs.modal', function() {
      $('#create-name').val(''),
      $('#create-tapel_id').val(''),
      $('#create-guru_id').val(''),

      $('.is-invalid').removeClass('is-invalid');
      $('.is-valid').removeClass('is-valid');
  });

  $('#modal-edit').on('hidden.bs.modal', function() {
      $('#edit-name').val(''),
      $('#edit-tapel_id').val(''),
      $('#edit-guru_id').val(''),

      $('.is-invalid').removeClass('is-invalid');
      $('.is-valid').removeClass('is-valid');
  });
</script>
