<script>

function successToast(success){
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

function infoToast(info){
  $(function() {
    $(document).Toasts('create', {
      class: 'bg-info',
      title: 'INFO',
      body: info
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

function warningToast(warning){
  $(function() {
    $(document).Toasts('create', {
      class: 'bg-warning',
      title: 'PERHATIAN',
      body: warning
    })
  });
  setTimeout(function() {
    $(".toast").fadeOut(500, function() {
      $(this).remove();
    });
  }, 4000);
}
</script>
