<script>
  $(document).ready(function(){

    // INDEX TABLE
    $('#myTableDeskripsi').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      paginate: false,
      ajax: {
        url: '/nilaiakhir/{{ $pembelajaran->id }}/edit',
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'nis', name: 'nis'},
        {data: 'name', name: 'name'},
        {data: 'nilai', name: 'nilai'},
        {data: 'deskripsi.optimal', name: 'deskripsi.optimal'},
        {data: 'deskripsi.kurang', name: 'deskripsi.kurang'},
      ]
    });

    // SETUP CSRF
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // UPDATE
    $('#form-update-deskripsi').on('submit', function(a){
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
          url: '/deskripsicapaian/{{ $pembelajaran->id }}/update',
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
              $('#myTableDeskripsi').DataTable().ajax.reload();
              successToast(response.success);
            }
          }
        });
    }

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

    $('body').on('click', '#capaian-tp-button', function(){
      loadAMoment();
      window.location.href = '/nilaiakhir/' + $(this).data('id')
    });

  });

  function validateInputNilai(input) {
    if (input.value > 100) {
      input.value = 100;
    }
  }
</script>
