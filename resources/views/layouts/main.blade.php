<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <title id="mainTitle">
    @isset($title)
        E-RAPORT KURIKULUM MERDEKA - {{ $title }}
    @else
        E-RAPORT KURIKULUM MERDEKA
    @endisset
  </title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  {{-- Select 2 --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css"> <!-- for live demo page -->
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/adminlte/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/adminlte/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.min.css">
  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  {{-- Yajra Datatable --}}
  <link href="/yajra/datatable.css" rel="stylesheet">
  {{-- <link href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/kt-2.11.0/datatables.min.css" rel="stylesheet"> --}}
  {{-- <link href="https://cdn.datatables.net/v/bs4/jq-3.7.0/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/kt-2.11.0/datatables.min.css" rel="stylesheet"> --}}
  {{-- MY CSS --}}
  <link rel="stylesheet" href="/customize/style.css">
  {{-- Datatable Simple --}}
  {{-- <link rel="stylesheet" href="/extensions/simple-datatables/style.css">
  <link rel="stylesheet" href="/extensions/simple-datatables.css"> --}}

  @yield('css')

</head>
<body class="{{ Auth::user()->dark_mode == '1' ? 'dark-mode' : ''}} hold-transition sidebar-mini layout-fixed" style="font-family: 'Figtree'" id="main-body">


<div class="wrapper">


  @include('layouts.navbar')

  @include('layouts.sidebar')

  <div class="content-wrapper">
    @yield('content')
  </div>

  @include('pages.auth.logout')

  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="" src="/img/loader.gif" alt="Loader" height="60" width="60">
  </div> --}}

  @include('layouts.footer')

  <!-- Control Sidebar -->
  @include('layouts.control-sidebar')
</div>
<!-- ./wrapper -->

<div id="loader" class="loader"></div>
<div id="loaderAtShow" class="loaderAtShow"></div>
<div id="loaderAMoment" class="loader"></div>

{{-- JS --}}
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
    // Ketika halaman dimuat, ambil data pengguna dari server
    $.ajax({
        type: 'GET',
        url: '/get-main-data', // Sesuaikan dengan URL yang Anda buat di route
        dataType: 'json',
        success: function(data) {
            // Memperbarui elemen HTML dengan data yang diambil dari server
            $('#userName').text(data.name);
            $('#userNameShort').text(data.nameShort);
            $('#userImage').attr('src', data.image);
            // $('#logoSekolah').attr('src', data.logoSekolah);
            // $('#mainTitle').text(data.mainTitle);
            // $('#navTitle').text(data.mainTitle);
            // $('#logoutTitle').text(data.mainTitle);
        }
    });

    // $('body').on('click', '#toggle_mode', function(){

    // })
  });
</script>


<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/adminlte/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/adminlte/plugins/moment/moment.min.js"></script>
<script src="/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/adminlte/dist/js/pages/dashboard.js"></script>
{{-- LOADER --}}
<script src="/customize/script.js"></script>
{{-- Tooltips --}}
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  });
</script>
<script>
  $(function () {
    $('[data-toggle="modal"]').tooltip()
  });
</script>
{{-- Popovers --}}
<script>
  $(function () {
    $('[data-toggle="popover"]').popover()
  });
  $('.popover-dismiss').popover({
  trigger: 'focus'
  })
</script>
{{-- Select2 --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" integrity="sha256-AFAYEOkzB6iIKnTYZOdUf9FFje6lOTYdwRJKwTN5mks=" crossorigin="anonymous"></script> --}}
<script src="/customize/select2/script.js"></script>
<script>
  $(document).ready(function() {
    $('.selectTwo').select2();
  });
</script>


{{-- Datatables Simple --}}
{{-- <script src="/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="/extensions/simple-datatables.js"></script> --}}

{{-- Yajra Datatable --}}
<script src="/yajra/datatable.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/kt-2.11.0/datatables.min.js"></script> --}}

@include('partials.toast')
<script>
  function scrollToTop(){
    $("html, body").animate({ scrollTop: 0 }, "fast");
  }
</script>
@yield('js')

</body>
</html>
