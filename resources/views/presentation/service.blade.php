<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Services Municipaux — IDOCS MALI</title>
  <link rel="stylesheet" href="{{ asset('gentelella/assets/cssPresentation/service.css') }}" />
</head>

<body>
  <header>
    <div class="container">
      <div class="header_wrapper">
        <div class="header_nav">
          <a href="#" class="nav_logo">
            <img src="{{ asset('gentelella/assets/cssPresentation/Idocs Mali.png') }}" alt="Logo IDOCS MALI"
              class="logo" width="100" height="100">
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

  <section class="services_section">
    <div class="container">
      <h2 class="section_title">Services Municipaux Offerts</h2>
      <p class="section_description">
        Grâce à IDOCS MALI, les citoyens peuvent accéder facilement à plusieurs services municipaux numérisés, sans
        déplacement ni files d’attente.
      </p>

      <div class="services_list">
        <div class="service_item">
          <h3>Acte de Naissance</h3>
          <p>Demandez, suivez et recevez votre acte de naissance entièrement en ligne.</p>
        </div>

        <div class="service_item">
          <h3>Acte de Mariage</h3>
          <p>Enregistrez ou obtenez une copie certifiée de votre acte de mariage.</p>
        </div>

        <div class="service_item">
          <h3>Acte de Décès</h3>
          <p>Effectuez les démarches pour un acte de décès rapidement via notre portail sécurisé.</p>
        </div>

        <div class="service_item">
          <h3>Certificat de Nationalité</h3>
          <p>Une procédure simplifiée pour faire la demande et obtenir votre certificat de nationalité.</p>
        </div>
      </div>
    </div>
  </section>
  <footer style="text-align: center; padding: 20px; background: #f8f8f8; margin-top: 40px;">
    <p>&copy; 2025 IDOCS MALI — Tous droits réservés</p>
  </footer>
</body>

</html>