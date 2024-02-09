<script>
  $(document).ready(function(){
    $('#myTable').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      ajax: {
        url: '{{ route('projek.index') }}',
        data: function(d) {
          d.fase_id = $('#fase_id-select').val();
        },
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'fase.name', name: 'fase.name'},
        {data: 'tema', name: 'tema'},
        {data: 'name', name: 'name'},
        {data: 'deskripsi', name: 'deskripsi'},
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
      infoToast('Filter berhasil diterapkan');
    });

    // SHOW
    $('body').on('click', '.show-button', function(e){
      showLoader();
      var id = $(this).data('id');
      $.ajax({
        url: '/projek/' + id,
        type: 'GET',
        success: function(response){
          hideLoader();
          $.each(response.result, function(field, value){
            $('#show-' + field).html(value); // Loop Semua Data
          });
          $('#modal-show').modal('show');
          $('#show-capaianprofil-route').data('id', response.result.id);
          $('#show-fase-name').html(response.result.fase.name);
          $('#show-jumlah-capaianprojek').html(response.result.capaian_projek.length);
          $('#show-jumlah-kelompok').html(response.result.projek_pilihan_kelompok.length);
        }
      });
    });

    // KELOLA CAPAIAN PROFIL
    $('body').on('click', '.show-capaianprofil-route', function(e){
      loadAMoment();
      window.location.href = '/capaianprojek/' + $(this).data('id');
    });

    // CREATE
    $('body').on('click', '.create-button', function(e) {
        e.preventDefault();
        $('#modal-create').modal('show');

        $('#store-button').off('click').click(function(s) {
          s.preventDefault();
          showLoaderAtShow();
          store();
        });
    });

    // STORE
    function store(){
      $.ajax({
        url: '{{ route('projek.store') }}',
        type: 'POST',
        data: {
          sekolah_id: $('#create-sekolah_id').val(),
          fase_id: $('#create-fase_id').val(),
          tema: $('#create-tema').val(),
          name: $('#create-name').val(),
          deskripsi: $('#create-deskripsi').val(),
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
              $('#modal-create').modal('hide');
              successToast(response.success);
              $('#myTable').DataTable().ajax.reload();
              clearCreateForm();
          }
        }
      });
    }

    // EDIT
    $('body').on('click', '.edit-button', function(e) {
        showLoader();
        var id = $(this).data('id');
        $.ajax({
          url: 'projek/' + id + '/edit',
          type: 'GET',
          success: function(response){
            hideLoader();
            $('#modal-edit').modal('show');

            $.each(response.dataEdit, function(field, value) {
              $('#edit-' + field).val(value);
            });

            $('#update-button').off('click').click(function(u) {
                u.preventDefault();
                showLoaderAtShow();
                update(id);
            });
          }
        })
    });

    // UPDATE
    function update(id){
      $.ajax({
        url: '/projek/' + id,
        type: 'PUT',
        data: {
          sekolah_id: $('#edit-sekolah_id').val(),
          fase_id: $('#edit-fase_id').val(),
          tema: $('#edit-tema').val(),
          name: $('#edit-name').val(),
          deskripsi: $('#edit-deskripsi').val(),
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
            $('#modal-edit').modal('hide');
            successToast(response.success);
            $('#myTable').DataTable().ajax.reload();
            clearEditForm();
          }
        }
      });
    }

    // DELETE
    $('body').on('click', '.delete-button', function(e) {
      var id = $(this).data('id');
      var name = $(this).data('name');

      $('#delete-projek-name').html(name);
      $('#modal-delete').modal('show');

      $('#confirm-delete-button').off('click').click(function() {
        $('#modal-delete').modal('hide');
        showLoaderAtShow();
          $.ajax({
              url: '/projek/' + id,
              type: 'DELETE',
              success: function(response) {
                if(response.failed){
                  $('#modal-edit').modal('hide');
                  failedToast(response.failed);
                } else {
                  hideLoaderAtShow();
                  successToast(response.success);
                  $('#myTable').DataTable().ajax.reload();
                }
              }
          });
      });
    });


  function clearCreateForm() {
    $('#create-fase_id').val('');
    $('#create-tema').val('');
    $('#create-name').val('');
    $('#create-deskripsi').val('');
    $('.is-invalid').removeClass('is-invalid');
    $('.is-valid').removeClass('is-valid');
  }

  function clearEditForm() {
    $('#edit-fase_id').val('');
    $('#edit-tema').val('');
    $('#edit-name').val('');
    $('#edit-deskripsi').val('');
    $('.is-invalid').removeClass('is-invalid');
    $('.is-valid').removeClass('is-valid');
  }

  });
</script>
