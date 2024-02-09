<script>
  $(document).ready(function() {
    $('#myTableShow').dataTable({
        processing: true,
        serveside: true,
        paginate: false,
        ajax: {
            url: '/catatanwalas/{{ $kelas->id }}',
            data: function(d){
              d.semester = '1';
            },
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'nis', name: 'nis' },
            { data: 'jk', name: 'jk' },
            { data: 'catatanwalas.catatan', name: 'catatanwalas.catatan' },
        ]
    });

    $('#form-update-catatanwalas').on('submit', function(e){
      e.preventDefault();
      if (document.getElementById('update-confirm').checked) {
        showLoader();
        $.ajax({
          url: '/catatanwalas/{{ $kelas->id }}',
          type: 'POST',
          data: new FormData(this),
          contentType: false,
          processData: false,

          success:function(response){
            hideLoader();
            if (response.failed){
              failedToast(response.failed);
            } else {
              $('#myTableShow').DataTable().ajax.reload();
              successToast(response.success);
            }
          }

        })
      } else {
        warningToast('Harap centang konfirmasi perubahan terlebih dahulu!');
      }
    });

  });
 </script>
