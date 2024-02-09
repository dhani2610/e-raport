<script>
  $(document).ready(function(){
    $('#myTable').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      ajax: {
        url: '{{ route('kelas.index') }}',
        data: function(d) {
          d.tingkat_id = $('#tingkat_id_select').val();
        },
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'id', name: 'id'},
        {data: 'name', name: 'name'},
        {data: 'guru.name', name: 'guru.name'},
        {data: 'tingkat.angka', name: 'tingkat.angka'},
        {data: 'siswa.count', name: 'siswa.count'},
        {data: 'aksi', name: 'aksi'},
      ]
    });

    // SETUP CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // FILTER
    $('body').on('click', '#filter-button', function(){
      $('#myTable').DataTable().ajax.reload();
      $('#modal-filter').modal('hide');
      toast('Filter berhasil diterapkan');
    });

    // SHOW
    $('body').on('click', '.show-button', function(){
      window.location.href = '/siswa';
    });

    // CREATE
    $('body').on('click', '.create-button', function(e) {
        e.preventDefault();
        $('#modal-create').modal('show');
        $('#store-button').off('click').click(function() {
          if (document.getElementById('store-confirm').checked) {
            $('#create-confirm-alert').addClass('d-none');
            $('#create-confirm-alert').removeClass('show');

            showLoaderAtShow();
            store();
          } else {
            $('#create-confirm-alert').addClass('show');
            $('#create-confirm-alert').removeClass('d-none');
          }
        });
    });

    // STORE
    function store(){
      $.ajax({
        url: '{{ route('kelas.store') }}',
        type: 'POST',
        data: {
          sekolah_id: $('#sekolah_id').val(),
          name: $('#create-name').val(),
          guru_id: $('#create-guru_id').val(),
          tapel_id: $('#create-tapel_id').val(),
          tingkat_id: $('#create-tingkat_id').val(),
        },

        success: function(response){
          hideLoaderAtShow();
          if (response.errors) {
            $('.create-field').removeClass('is-invalid');
            $('.create-field').addClass('is-valid');
            $('.invalid-feedback').html('');

            $.each(response.errors, function(field, errors) {
                $('#create-' + field).removeClass('is-valid');
                $('#create-' + field).addClass('is-invalid');
                $('#error-create-' + field).html(errors[0]);
            });

          } else if(response.failed){
            $('#modal-create').modal('hide');
            failedToast(response.failed);

          } else {
            toast(response.success);
            $('#modal-create').modal('hide');
          }
          $('#myTable').DataTable().ajax.reload();
        }
      });
    }

    // EDIT
    $('body').on('click', '.edit-button', function(e) {
        showLoader();
        var id = $(this).data('id');
        $.ajax({
          url: 'kelas/' + id + '/edit',
          type: 'GET',
          success: function(response){
            hideLoader();
            $('#modal-edit').modal('show');

            $.each(response.dataEdit, function(field, value) {
              $('#edit-' + field).val(value);
            });

            $('#update-button').off('click').click(function() {
              if (document.getElementById('update-confirm').checked) {
                $('#edit-confirm-alert').addClass('d-none');
                $('#edit-confirm-alert').removeClass('show');
                showLoaderAtShow();
                update(id);
              } else {
                $('#edit-confirm-alert').addClass('show');
                $('#edit-confirm-alert').removeClass('d-none');
              }
            });
          }
        })
    });

    function update(id){
      $.ajax({
        url: 'kelas/' + id,
        type: 'PUT',
        data: {
          sekolah_id: $('#edit-sekolah_id').val(),
          name: $('#edit-name').val(),
          guru_id: $('#edit-guru_id').val(),
          tapel_id: $('#edit-tapel_id').val(),
          tingkat_id: $('#edit-tingkat_id').val(),
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
            toast(response.success);
            $('#modal-edit').modal('hide');
          }
          $('#myTable').DataTable().ajax.reload();
        }
      });
    }

    // // SHOW
    // $('body').on('click', '.show-button', function(e){
    //   var id = $(this).data('id');
    //   $.ajax({
    //     url: '/admin/' + id,
    //     type: 'GET',
    //     success: function(response){
    //       $('#modal-show').modal('show');
    //       $.each(response.result, function(field, value){
    //         if (field == 'jk') value = (value == 'L') ? 'LAKI-LAKI' : 'PEREMPUAN'; // Jenis Kelamin
    //         $('#show-' + field).html(value); // Loop Semua Data
    //       });

    //       $('#show-edit-route').data('id', response.result.id);
    //       $('#show-user-foto').attr('src', '/img/'+response.result.user.foto);
    //       $('#show-user-is_aktif').addClass(response.result.user.is_aktif == 1 ? 'bg-success' : 'bg-danger').html(response.result.user.is_aktif == 1 ? 'AKTIF' : 'NON-AKTIF');

    //       var tgllahir = response.result.tanggallahir.split('-')[2] + '-' + response.result.tanggallahir.split('-')[1] + '-' + response.result.tanggallahir.split('-')[0]
    //       $('#show-ttl').html(response.result.tempatlahir + ', ' + tgllahir);
    //     }
    //   });
    // });

    // DELETE
    $('body').on('click', '.delete-button', function(e) {
    showLoader();
    var id = $(this).data('id');

      $.ajax({
          url: '/kelas/' + id + '/name',
          type: 'GET',
          success: function(response) {
            hideLoader();
              console.log(response.name);
              $('#modal-delete').modal('show');
              $('#delete-kelas-name').html(response.name);

              $('#confirm-delete-button').off('click').click(function() {
                $('#modal-delete').modal('hide');
                showLoaderAtShow();
                  $.ajax({
                      url: '/kelas/' + id,
                      type: 'DELETE',
                      success: function(response) {
                        hideLoaderAtShow();
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
      $('#create-name').val('');
      $('#create-guru_id').val('');
      $('#create-tapel_id').val('');
      $('#create-tingkat_id').val('');

      $('.is-invalid').removeClass('is-invalid');
      $('.is-valid').removeClass('is-valid');
    });
</script>
