<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil — IDOCS MALI</title>
    @yield('links')
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">


</head>

<body>
    @yield('content')
    <footer style="text-align: center; padding: 20px;margin-top: 5px;">
        <p>&copy; 2025 IDOCS MALI — Tous droits réservés</p>
    </footer>
</body>
@if(session('success'))
<script>
    Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: '{{ session("success") }}',
            confirmButtonColor: '#198754'
        });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: '{{ session("error") }}',
            confirmButtonColor: '#d33'
        });
</script>
@endif

</html>