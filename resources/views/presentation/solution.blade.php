<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil — IDOCS MALI</title>
    <link rel="stylesheet" href="{{ asset('gentelella/assets/cssPresentation/solution.css') }}">


</head>

<body>
    <header>
        <div class="container">
            <div class="header_wrapper">
                <div class="header_nav">
                    <a href="#" class="nav_logo">
                        <!--<img src="{{ asset('gentelella/assets/cssPresentation/Idocs Mali.png') }}" alt="Logo IDOCS MALI"
                            class="logo" width="100" height="100"> -->
                    </a>
                    <div class="nav_items">
                        <a href="{{ route('presentation.index') }}" class="nav_btn">Accueil</a>
                        <a href="{{ route('presentation.solution') }}" class="nav_btn">Nos Solutions</a>
                        <a href="{{ route('login') }}" class="nav_btn">Se connecter</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="solutions_section">
        <div class="container">
            <h2 class="section_title">Nos Solutions Numériques</h2>
            <p class="section_description">
                Découvrez nos solutions innovantes pour faciliter la gestion des documents administratifs dans les
                mairies du Mali.
                Nous vous proposons des outils pour digitaliser, sécuriser et optimiser les démarches administratives.
            </p>
            <div class="solutions_list">
                <div class="solution_item">
                    <h3>Gestion des Actes Civils</h3>
                    <p>Numérisation des actes de naissance, mariage, décès et certificats pour une gestion plus rapide
                        et sécurisée.</p>
                </div>
                <div class="solution_item">
                    <h3>Plateforme de Demandes en Ligne</h3>
                    <p>Permet aux citoyens de faire leurs demandes d’actes en ligne, de suivre leur statut et d’obtenir
                        leurs documents sans se déplacer.</p>
                </div>
                <div class="solution_item">
                    <h3>Système de Paiement Intégré</h3>
                    <p>Intégration d’un système de paiement mobile pour simplifier les démarches de paiement des actes
                        administratifs.</p>
                </div>
                <div class="solution_item">
                    <h3>Archivage Sécurisé</h3>
                    <p>Une solution d’archivage électronique pour une conservation longue durée des documents
                        administratifs, accessible en tout temps.</p>
                </div>
            </div>
        </div>
    </section>
    <footer style="text-align: center; padding: 20px; background: #f8f8f8; margin-top: 40px;">
        <p>&copy; 2025 IDOCS MALI — Tous droits réservés</p>
    </footer>
</body>

</html>