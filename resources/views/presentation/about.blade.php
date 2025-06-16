<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>À propos — IDOCS MALI</title>
  <link rel="stylesheet" href="{{ asset('gentelella/assets/cssPresentation/about.css') }}" />

</head>

<body>
  <header>
    <div class="container">
      <div class="header_wrapper">
        <div class="header_nav">
          <a href="#" class="nav_logo">
            <!-- <img src="{{ asset('gentelella/assets/cssPresentation/Idocs Mali.png') }}" alt="Logo IDOCS MALI"
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

  <main class="about_section">
    <h2>À propos de IDOCS MALI</h2>
    <p>
      IDOCS MALI est une initiative numérique innovante conçue pour répondre aux
      défis liés à la gestion des documents administratifs dans les mairies du Mali.
      Notre objectif est de simplifier, sécuriser et accélérer les procédures
      d’établissement et de délivrance d’actes civils (naissance, mariage, décès,
      certificats, etc.).
    </p>

    <p>
      Grâce à une plateforme intuitive et accessible, IDOCS MALI permet aux citoyens
      de faire leurs demandes en ligne, de suivre l’avancement du traitement et de
      recevoir leurs documents sans encombre.
    </p>

    <div class="about_highlight">
      <strong>Notre mission :</strong> Digitaliser l’administration locale pour
      améliorer la transparence, l’efficacité et la satisfaction des citoyens.
    </div>

    <div class="about_team">
      <h3>Notre Équipe</h3>
      <ul>
        <li>Mahamadou Diarra — Chef de projet</li>
        <li>Fatoumata Koné — Développeuse full-stack</li>
        <li>Souleymane Traoré — Spécialiste UX/UI</li>
        <li>Fanta Coulibaly — Chargée de communication</li>
      </ul>
    </div>
  </main>

  <footer style="text-align: center; padding: 20px; background: #f8f8f8; margin-top: 40px;">
    <p>&copy; 2025 IDOCS MALI — Tous droits réservés</p>
  </footer>
</body>

</html>