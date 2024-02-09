<script>
  $(document).ready(function(){
    $('#myTableShow').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      paginate: false,
      ajax: {
        url: '/projekpilihankelompok/catatan/{{ $projekpilihankelompok->id }}',
        // data: function(d){
        //   d.capaian_projek_id = $('#capaian-projek-select').val();
        // }
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
        {data: 'nis', name: 'nis'},
        {data: 'name', name: 'name'},
        {data: 'jk', name: 'jk'},
        {data: 'keterangan', name: 'keterangan'},
      ]
    });

     // UPDATE
     $('#form-update-catatan').on('submit', function(a){
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
        url: '/projekpilihankelompok/catatan/update/{{ $projekpilihankelompok->id }}',
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
