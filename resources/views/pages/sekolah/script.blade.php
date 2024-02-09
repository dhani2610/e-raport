<script>
  function previewImage() {
      const image = document.querySelector('#gambar');
      const imgPreview = document.querySelector('.img-preview');

      // imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(gambar.files[0]);


      oFReader.onload = function(oFREvent) {
          imgPreview.src = oFREvent.target.result;
      }
  }

</script>


<script>
  $(document).ready(function(){
    // SETUP CSRF
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $('body').on('click', '#update-data-button', function(){
        if (document.getElementById('update-data-confirm').checked) {
          showLoader();
          updateData();
        } else {
          warningToast('Harap centang konfirmasi perubahan terlebih dahulu!');
        }
      });

    $('#form-update-logo').on('submit', function(e){
      e.preventDefault();
      showLoader();
      $.ajax({
        url: '/sekolah/updatelogo',
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,

        success:function(response){
          hideLoader();
          $('.logo-field').removeClass('is-invalid');
          $('#error-logo').html();
          if (response.errors) {
            $.each(response.errors, function(field, errors) {
              $('.logo-field').addClass('is-invalid');
              $('#error-logo').html(errors);
            });
          } else if(response.failed){
            failedToast(response.failed);
          } else {
            successToast(response.success);
          }
        }

      })

    });

  });

    function updateData(){
      var data = [];
      // $('[id^=edit-data-]').each(function() {
      //     data[$(this).attr('id').replace('edit-data', '')] = $(this).val();
      // });

      $.ajax({
        url: '/sekolah/updatedata',
        type: 'PUT',
        data: {
          name: $('#edit-data-name').val(),
          npsn: $('#edit-data-npsn').val(),
          nss: $('#edit-data-nss').val(),
          kodepos: $('#edit-data-kodepos').val(),
          telepon: $('#edit-data-telepon').val(),
          alamat: $('#edit-data-alamat').val(),
          email: $('#edit-data-email').val(),
          website: $('#edit-data-website').val(),
          namakepsek: $('#edit-data-namakepsek').val(),
          nipkepsek: $('#edit-data-nipkepsek').val(),
        },

        success: function(response){
          console.log(response.req);
          if (response.errors) {
            hideLoader();
            $('.edit-data-field').removeClass('is-invalid');
            $('.edit-data-field').addClass('is-valid');
            $('.invalid-feedback').html('');

            $.each(response.errors, function(field, errors) {
                $('#edit-data-' + field).removeClass('is-valid');
                $('#edit-data-' + field).addClass('is-invalid');
                $('#error-data-' + field).html(errors[0]);
            });
          } else {
            $('.edit-data-field').removeClass('is-invalid');
            $('.edit-data-field').removeClass('is-valid');
            $('.invalid-feedback').html('');
            hideLoader();
            successToast(response.success);
            $("html, body").animate({ scrollTop: 0 }, "fast");
          }
        }
      });
    }
</script>
