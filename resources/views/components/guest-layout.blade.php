<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pertanian  @isset($title)
        - {{ $title }}
    @endisset</title>
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/login-template/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login-template/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login-template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login-template/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login-template/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/login-template/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login-template/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login-template/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/login-template/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login-template/css/util.css">
	<link rel="stylesheet" type="text/css" href="/login-template/css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	{{$slot}}
	
<!--===============================================================================================-->
	<script src="/login-template/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/login-template/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/login-template/vendor/bootstrap/js/popper.js"></script>
	<script src="/login-template/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/login-template/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/login-template/vendor/daterangepicker/moment.min.js"></script>
	<script src="/login-template/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/login-template/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/login-template/js/main.js"></script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('ERR'))
    <script>
      Swal.fire({
        title: "ERROR!",
        text: "{{ session('ERR') }}",
        icon: "error",
        confirmButtonClass: "btn btn-primary",
      });
    </script>
    @endif
    @if (session('OK'))
        <script>
        Swal.fire({
            title: "OK!",
            text: "{{ session('OK') }}",
            icon: "success",
            confirmButtonClass: "btn btn-primary",
        });
        </script>
    @endif

</body>
</html>