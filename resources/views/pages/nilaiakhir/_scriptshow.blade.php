<script>
  $(document).ready(function(){

    $('#myTableShow').on('draw.dt', function () {
      $('input[type="checkbox"]').change(function() {
        var checkboxId = $(this).attr('id');

        if (checkboxId.includes('optimal')) {
          if ($(this).prop('checked')) {
            var kurangCheckboxId = checkboxId.replace('optimal', 'kurang');
            $('#' + kurangCheckboxId).prop('disabled', true);
          } else {
            var kurangCheckboxId = checkboxId.replace('optimal', 'kurang');
            $('#' + kurangCheckboxId).prop('disabled', false);
          }
        } else if (checkboxId.includes('kurang')) {
          if ($(this).prop('checked')) {
            var optimalCheckboxId = checkboxId.replace('kurang', 'optimal');
            $('#' + optimalCheckboxId).prop('disabled', true);
          } else {
            var optimalCheckboxId = checkboxId.replace('kurang', 'optimal');
            $('#' + optimalCheckboxId).prop('disabled', false);
          }
        }
      });

       // Mendeteksi status default dan mengatur ketergantungan
      $('input[type="checkbox"]').each(function() {
        var checkboxId = $(this).attr('id');

        if (checkboxId.includes('optimal') && $(this).prop('checked')) {
          var kurangCheckboxId = checkboxId.replace('optimal', 'kurang');
          $('#' + kurangCheckboxId).prop('disabled', true);
        } else if (checkboxId.includes('kurang') && $(this).prop('checked')) {
          var optimalCheckboxId = checkboxId.replace('kurang', 'optimal');
          $('#' + optimalCheckboxId).prop('disabled', true);
        }
      });
    });

    // INDEX TABLE
    $('#myTableShow').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      paginate: false,
      ajax: {
        url: '/nilaiakhir/{{ $pembelajaran->id }}',
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'nis', name: 'nis'},
        {data: 'name', name: 'name'},
        {data: 'nilai', name: 'nilai'},
        {data: 'pencapaian.optimal', name: 'pencapaian.optimal'},
        {data: 'pencapaian.kurang', name: 'pencapaian.kurang'},
      ]
    });

    // SETUP CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // UPDATE
    $('#form-update-nilai').on('submit', function(a){
      a.preventDefault();
      if (document.getElementById('update-confirm').checked) {
        showLoader();
        var upData = new FormData(this);
        update(upData);
      } else {
        warningToast('Harap centang konfirmasi perubahan terlebih dahulu!');
      }
    });

    function update(upData){
      $.ajax({
          url: '/nilaiakhir/{{ $pembelajaran->id }}',
          type: 'POST',
          data: upData,
          contentType: false,
          processData: false,

          success:function(response){
            hideLoader();
            if (response.failed) {
              failedToast(response.failed);
            } else {
              scrollToTop();
              $('#myTableShow').DataTable().ajax.reload();
              successToast(response.success);
            }
          }
        });
    }

    $('body').on('click', '#deskripsi-button', function(){
      loadAMoment();
      window.location.href = '/nilaiakhir/' + $(this).data('id') + '/edit';
    });

    $('body').on('click', '#terapkan-nilai-rata-button', function(){
      $('#modal-terapkan-nilai').modal('show');

      $('#terapkan-nilai-submit').off('click').click(function(){
        $('#modal-terapkan-nilai').modal('hide');
        var valInput = $('#terapkan-nilai-input').val();
        if (valInput) {
          infoToast('Berhasil menerapkan nilai rata');
          $('.nilaiakhir-input').val(valInput);
        } else {
          warningToast('Penerapan nilai rata gagal!');
        }
      })
    });

  });

  function validateInputNilai(input) {
    if (input.value > 100) {
      input.value = 100;
    }
  }
</script>
