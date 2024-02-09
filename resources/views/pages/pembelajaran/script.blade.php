<script>
  $(document).ready(function(){
    $('#myTable').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      ajax: {
        url: '{{ route('pembelajaran.index') }}',
        data: function(d) {
          d.mapel_id = $('#mapel_id-select').val();
          d.kelas_id = $('#kelas_id-select').val();
          d.guru_id = $('#guru_id-select').val();
        },
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'mapel.name', name: 'mapel.name'},
        {data: 'kelas.name', name: 'kelas.name'},
        {data: 'guru.name', name: 'guru.name'},
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

    // SHOW TUJUAN PEMBELAJARAN
    $('body').on('click', '.tp-button', function(){
      loadAMoment();
      window.location.href = '/tujuanpembelajaran/' +$(this).data('id');
    });

    // SHOW NILAI AKHIR
    $('body').on('click', '.nilai-button', function(){
      loadAMoment();
      window.location.href = '/nilaiakhir/' +$(this).data('id');
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
        url: '{{ route('pembelajaran.store') }}',
        type: 'POST',
        data: {
          sekolah_id: $('#create-sekolah_id').val(),
          mapel_id: $('#create-mapel_id').val(),
          kelas_id: $('#create-kelas_id').val(),
          guru_id: $('#create-guru_id').val(),
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
          url: 'pembelajaran/' + id + '/edit',
          type: 'GET',
          success: function(response){
            hideLoader();
            $('#modal-edit').modal('show');

            console.log(response.dataEdit);
            console.log('====================================');
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
        url: 'pembelajaran/' + id,
        type: 'PUT',
        data: {
          sekolah_id: $('#edit-sekolah_id').val(),
          mapel_id: $('#edit-mapel_id').val(),
          kelas_id: $('#edit-kelas_id').val(),
          guru_id: $('#edit-guru_id').val(),
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

    // DELETE
    $('body').on('click', '.delete-button', function(e) {
      var id = $(this).data('id');
      var name = $(this).data('name');

      $('#modal-delete').modal('show');
      $('#delete-pembelajaran-name').html(name);

      $('#confirm-delete-button').off('click').click(function() {
        $('#modal-delete').modal('hide');
        showLoaderAtShow();
          $.ajax({
              url: '/pembelajaran/' + id,
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
      $('#create-mapel_id').val(''),
      $('#create-kelas_id').val(''),
      $('#create-guru_id').val(''),

      $('.is-invalid').removeClass('is-invalid');
      $('.is-valid').removeClass('is-valid');
  });

  $('#modal-edit').on('hidden.bs.modal', function() {
      $('#edit-mapel_id').val(''),
      $('#edit-kelas_id').val(''),
      $('#edit-guru_id').val(''),

      $('.is-invalid').removeClass('is-invalid');
      $('.is-valid').removeClass('is-valid');
  });
</script>
