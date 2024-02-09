<script>
  $(document).ready(function(){

    // INDEX TABLE
    $('#myTable').dataTable({
      processing:true,
      serveside: true,
      ordering: false,
      ajax: {
        url: '{{ route('nilaiakhir.index') }}',
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
      infoToast('Filter berhasil diterapkan');
    });

    // SHOW
    $('body').on('click', '.show-button', function(){
      loadAMoment();
      window.location.href = '/nilaiakhir/' +$(this).data('id');
    });

  });
</script>
