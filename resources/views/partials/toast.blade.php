@if (session()->has('success'))

  <script>
    $(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'BERHASIL',
        body: '{!! session('success') !!}'
      })
    });
  </script>

@elseif (session()->has('info'))

<script>
  $(function() {
        $(document).Toasts('create', {
          class: 'bg-info',
          title: 'INFORMASI',
          body: '{!! session('info') !!}'
      })
    });
  </script>

@elseif (session()->has('warning'))

<script>
  $(function() {
        $(document).Toasts('create', {
          class: 'bg-warning',
          title: 'PERINGATAN',
          body: '{!! session('warning') !!}'
      })
    });
  </script>

@elseif (session()->has('failed'))

<script>
  $(function() {
        $(document).Toasts('create', {
          class: 'bg-danger',
          title: 'GAGAL',
          body: '{!! session('failed') !!}'
      })
    });
  </script>

@endif

<script>
  setTimeout(function() {
  $(".toast").fadeOut(500, function() {
    $(this).remove();
  });
}, 4000);
</script>
