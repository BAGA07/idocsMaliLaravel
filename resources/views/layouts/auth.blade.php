<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Authentification</title>
    <!-- Bootstrap -->
    <link href="{{ asset('gentelella/assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('gentelella/assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('gentelella/assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('gentelella/assets/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom TheStyle -->
    
    <link href="{{ asset('gentelella/assets/build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentelella/assets/build/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href=" {{ asset('gentelella/assets/css/style.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image" href="{{ asset('gentelella/assets/images/favicon.png') }}">
</head>

<body class="login">
    <div>
        @yield('content')
    </div>
</body>

</html>