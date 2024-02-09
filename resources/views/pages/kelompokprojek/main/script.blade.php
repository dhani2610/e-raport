<script>
  $(document).ready(function(){
    $('#myTable').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      ajax: {
        url: '{{ route('kelompok.index') }}',
        data: function(d) {
          d.kelas_id = $('#kelas_id-select').val();
          d.guru_id = $('#guru_id-select').val();
        },
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'name', name: 'name'},
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
      infoToast('Filter berhasil diterapkan');
    });

    // SHOW
    $('body').on('click', '.show-button', function(e){
      showLoader();
      var id = $(this).data('id');
      $.ajax({
        url: '/kelompok/' + id,
        type: 'GET',
        success: function(response){
          hideLoader();
          $.each(response.result, function(field, value){
            $('#show-' + field).html(value); // Loop Semua Data
          });
          $('#modal-show').modal('show');
          $('#show-capaianprofil-route').data('id', response.result.id);
          $('#show-fase-name').html(response.result.fase.name);
          $('#show-jumlah-capaiankelompok').html(response.result.capaian_kelompok.length);
          $('#show-jumlah-kelompok').html(response.result.kelompok_pilihan_kelompok.length);
        }
      });
    });

    // KELOLA PROJEK PILIHAN
    $('body').on('click', '.show-projekpilihan-button', function(e){
      loadAMoment();
      window.location.href = '/projekpilihankelompok/' + $(this).data('id');
    });

    // KELOLA ANGGOTA KELOMPOK
    $('body').on('click', '.show-anggota-button', function(e){
      loadAMoment();
      window.location.href = '/anggotakelompok/' + $(this).data('id');
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
        url: '{{ route('kelompok.store') }}',
        type: 'POST',
        data: {
          sekolah_id: $('#create-sekolah_id').val(),
          kelas_id: $('#create-kelas_id').val(),
          guru_id: $('#create-guru_id').val(),
          name: $('#create-name').val(),
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
          url: 'kelompok/' + id + '/edit',
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
        url: '/kelompok/' + id,
        type: 'PUT',
        data: {
          sekolah_id: $('#edit-sekolah_id').val(),
          kelas_id: $('#edit-kelas_id').val(),
          guru_id: $('#edit-guru_id').val(),
          name: $('#edit-name').val(),
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

      $('#delete-kelompok-name').html(name);
      $('#modal-delete').modal('show');

      $('#confirm-delete-button').off('click').click(function() {
        $('#modal-delete').modal('hide');
        showLoaderAtShow();
          $.ajax({
              url: '/kelompok/' + id,
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
    $('#create-kelas_id').val('');
    $('#create-guru_id').val('');
    $('#create-name').val('');
    $('.is-invalid').removeClass('is-invalid');
    $('.is-valid').removeClass('is-valid');
  }

  function clearEditForm() {
    $('#edit-kelas_id').val('');
    $('#edit-guru_id').val('');
    $('#edit-name').val('');
    $('.is-invalid').removeClass('is-invalid');
    $('.is-valid').removeClass('is-valid');
  }

  });
</script>
