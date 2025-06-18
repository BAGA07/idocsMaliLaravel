<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Idocs-Mali</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('gentelella/assets/cssPresentation/form.css') }}">
</head>

<body>
    <div class="form-container">
        <h2>Faire une demande de document</h2>
        <form method="POST" action="{{ route('demande.store') }}" enctype="multipart/form-data">
            @csrf
            <label for="nom">Nom complet</label>
            <input type="text" name="nom" required>

            <label for="email">Email</label>
            <input type="email" name="email" required>

            <label for="telephone">Téléphone</label>
            <input type="tel" name="telephone" required>

            <label for="type_document">Type de document</label>
            <select name="type_document" id="type_document" required onchange="toggleJustificatif()">
                <option value="">-- Choisir un type --</option>
                <option value="Acte de naissance">Acte de naissance</option>
                <option value="Actes de mariage">Actes de mariage</option>
                <option value="Carte d'identité">Carte d'identité</option>
            </select>

            <div id="justificatifDiv" class="hidden">
                <label for="justificatif">Justificatif</label>
                <input type="file" name="justificatif" accept=".pdf,.jpg,.jpeg,.png">
            </div>

            <label for="informations_complementaires">Informations complémentaires</label>
            <textarea name="informations_complementaires" rows="4"></textarea>

            <button type="submit">Soumettre la demande</button>
        </form>
    </div>

    <script>
        function toggleJustificatif() {
            const typeDoc = document.getElementById('type_document').value;
            const justificatifDiv = document.getElementById('justificatifDiv');

            if (typeDoc === 'Acte de naissance') {
                justificatifDiv.classList.remove('hidden');
            } else {
                justificatifDiv.classList.add('hidden');
            }
        }
    </script>
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




</body>

</html>