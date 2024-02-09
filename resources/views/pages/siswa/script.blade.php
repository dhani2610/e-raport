<script>
  $(document).ready(function(){
    $('#myTable').DataTable({
      processing: true,
      serverside: true,
      ordering: false,
      ajax: {
        url: '{{ route('siswa.index') }}',
        data: function(d) {
          d.jk = $('#jk_select').val();
          d.kelas_id = $('#kelas_id_select').val();
          d.is_aktif = $('#is_aktif_select').val();
        },
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'name', name: 'name'},
        {data: 'kelas.name', name: 'kelas.name'},
        {data: 'nis-nisn', name: 'nis-nisn'},
        {data: 'jk', name: 'jk'},
        {data: 'user.is_aktif', name: 'user.is_aktif'},
        {data: 'aksi', name: 'aksi'},
      ],
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
      // toast('Filter berhasil diterapkan');
    });

    // EDIT
    $('body').on('click', '.edit-button', function() {
      showLoader();
      window.location.href = "/siswa/" + $(this).data('id') + '/edit';
    });

    // SHOW
    $('body').on('click', '.show-button', function(e){
      showLoader();
      var id = $(this).data('id');
      $.ajax({
        url: 'siswa/' + id,
        type: 'GET',
        success: function(response) {
          hideLoader();
          $('#modal-show').modal('show');

          $.each(response.result, function(field, value){

            if (field === 'diterimaditanggal' && value) { // Merubah tanggal ke depan
              if (value.split('-').length === 3) value = value.split('-')[2] + '-' + value.split('-')[1] + '-' + value.split('-')[0];
            }

            if (field == 'statusdalamkeluarga' && value) { // Merubah singkatan
              if (value == 'AK') {
                value = 'ANAK KANDUNG';
              } else if (value == 'AT') {
                value = 'ANAK TIRI';
              } else if (value == 'AA') {
                value = 'ANAK ANGKAT';
              }
            }

            if (field == 'jk') value = (value == 'L') ? 'LAKI-LAKI' : 'PEREMPUAN'; // Jenis Kelamin
            $('#show-' + field).html(value); // Loop Semua Data

          });

          $('#show-edit-route').data('id', response.result.id);

          if (response.result.kelas != null) $('#show-kelas-name').html(response.result.kelas.name);
          $('#show-user-foto').attr('src', '/img/'+response.result.user.foto);
          $('#show-user-is_aktif').addClass(response.result.user.is_aktif == 1 ? 'bg-success' : 'bg-danger').html(response.result.user.is_aktif == 1 ? 'AKTIF' : 'NON-AKTIF');

          var tgllahir = response.result.tanggallahir.split('-')[2] + '-' + response.result.tanggallahir.split('-')[1] + '-' + response.result.tanggallahir.split('-')[0]
          $('#show-ttl').html(response.result.tempatlahir + ', ' + tgllahir);
        }
      });
    });

    // DELETE
    $('body').on('click', '.delete-button', function(e) {
    showLoader();
    var id = $(this).data('id');

      $.ajax({
          url: '/siswa/' + id + '/get-name',
          type: 'GET',
          success: function(response) {
            hideLoader();
              var siswaName = response.name;
              $('#modal-delete').modal('show');

              $('#delete-siswa-name').html(siswaName);

              $('#confirm-delete-button').off('click').click(function() {
                $('#modal-delete').modal('hide');
                showLoader();
                  $.ajax({
                      url: '/siswa/' + id,
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


    $('#confirm-import-button').click(function() {
      if ($('#import-confirm').prop('checked') && $('#file').val()) {
        showLoader();
        $('#modal-import').modal('hide');
      }
    });

    //  // CREATE IMPORT
    //  $('body').on('click', '.import-button', function(e) {
    //     e.preventDefault();
    //     $('#modal-import').modal('show');
    //     $('#confirm-import-button').off('click').click(function() {
    //         showLoaderAtShow();
    //         store();
    //     });
    // });

    // // STORE IMPORT
    // function store(){
    //   hideLoaderAtShow()
    //   var formData = new FormData();
    //   formData.append('file', $('#create-file')[0].files[0]);
    //   console.log(formData);

    //   $.ajax({
    //     url: '{{ route('siswa.import') }}',
    //     type: 'POST',
    //     data: formData,

    //     success: function(response){
    //       hideLoaderAtShow();
    //       if (response.errors) {
    //         $('.create-field').removeClass('is-invalid');
    //         $('.create-field').addClass('is-valid');
    //         $('.invalid-feedback').html('');

    //         $.each(response.errors, function(field, errors) {
    //             $('#create-' + field).removeClass('is-valid');
    //             $('#create-' + field).addClass('is-invalid');
    //             $('#error-create-' + field).html(errors[0]);
    //         });

    //       } else if(response.failed){
    //         $('#modal-import').modal('hide');
    //         failedToast(response.failed);

    //       } else {
    //         toast(response.success);
    //         $('#modal-import').modal('hide');
    //       }
    //       $('#myTable').DataTable().ajax.reload();
    //     }
    //   });
    // }

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

$('#modal-show').on('hidden.bs.modal', function() {
    $('.show_value').html('');
    $('#show-user-is_aktif').removeClass(['bg-danger', 'bg-success']);
});

$('#modal-import').on('hidden.bs.modal', function() {
  $('#create-file').val('');

  $('.is-invalid').removeClass('is-invalid');
  $('.is-valid').removeClass('is-valid');
});
</script>
