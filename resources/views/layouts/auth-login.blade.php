
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{asset('images/BMI_Group_Logo.jpeg')}}">
  <title>
    BMI Portal
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('soft-theme/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('soft-theme/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('soft-theme/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('soft-theme/assets/css/soft-ui-dashboard.css?v=1.0.9')}}" rel="stylesheet" />
</head>

<body class="">
  @yield('content')
  
  <!--   Core JS Files   -->
  <script src="{{asset('soft-theme/assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('soft-theme/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('soft-theme/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('soft-theme/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <!-- Kanban scripts -->
  <script src="{{asset('soft-theme/assets/js/plugins/dragula/dragula.min.js')}}"></script>
  <script src="{{asset('soft-theme/assets/js/plugins/jkanban/jkanban.js')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('soft-theme/assets/js/soft-ui-dashboard.min.js?v=1.0.9')}}"></script>
</body>

</html>