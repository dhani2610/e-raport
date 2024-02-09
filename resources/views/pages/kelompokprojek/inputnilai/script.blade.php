<script>
  $(document).ready(function(){
    $('#myTableShow').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      paginate: false,
      ajax: {
        url: '/projekpilihankelompok/nilai/{{ $projekpilihankelompok->id }}',
        data: function(d){
          d.capaian_projek_id = $('#capaian-projek-select').val();
        }
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'nis', name: 'nis'},
        {data: 'name', name: 'name'},
        {data: 'jk', name: 'jk'},
        {data: 'predikat', name: 'predikat'},
      ]
    });

    if ($('#capaian-projek-select').val()) {
      $('#detail-capaianprofil-button').removeClass('d-none');
    } else {
      $('#detail-capaianprofil-button').addClass('d-none');
    }

    // DETAIL CAPAIAN PROFIL
    $('body').on('click', '#detail-capaianprofil-button', function(e){
      showLoader();
      var id = $('#capaian-projek-select').val();
        $.ajax({
          url: '/getcapaianakhir/' + id,
          type: 'GET',
          success: function(response){
            console.log(response.result);
            hideLoader();
            $('#modal-capaianakhir').modal('show');
            $('#show-dimensi').html(response.result.sub_elemen.elemen.dimensi.name);
            $('#show-elemen').html(response.result.sub_elemen.elemen.name);
            $('#show-sub_elemen').html(response.result.sub_elemen.name);
            $('#show-capaian_akhir').html(response.result.name);
          }
        });
    });

    // PILIH CAPAIAN PROJEK
    $('#capaian-projek-select').change(function(){
      $('#myTableShow').DataTable().ajax.reload();
    });

    // TERAPKAN PREDIKAT RATA
    $('body').on('click', '#terapkan-predikat-rata-button', function(){
      $('#modal-terapkan-predikat').modal('show');

      $('#terapkan-predikat-submit').off('click').click(function(){
        $('.predikat-siswa').val($('#terapkan-predikat-rata-select').val());
        infoToast('Berhasil menerapkan predikat ke semua siswa');
        $('#modal-terapkan-predikat').modal('hide');
      })
    });

     // UPDATE
     $('#form-update-predikat').on('submit', function(a){
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
        url: '/projekpilihankelompok/nilai/update/' + $('#capaian-projek-select').val(),
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
  });
</script>
