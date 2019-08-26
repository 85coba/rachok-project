<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>RachokAdmin</title>

<!-- Custom fonts for this template-->
<link href="{{ app()->environment('local')
    ? asset('vendor/fontawesome-free/css/all.min.css')
    : secure_asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>
  <body id="page-top">
    <div id="wrapper">
        @include('inc.navi')
        @yield('content')
        @include('inc.footer')

    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ app()->environment('local')
      ? asset('vendor/jquery/jquery.min.js')
      : secure_asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ app()->environment('local')
      ? asset('vendor/bootstrap/js/bootstrap.bundle.min.js')
      : secure_asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ app()->environment('local')
      ? asset('vendor/jquery-easing/jquery.easing.min.js')
      : secure_asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ app()->environment('local')
      ? asset('js/sb-admin-2.min.js')
      : secure_asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
  </body>
</html>