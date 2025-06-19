@extends('layouts.presentation')
@section('links')
<link rel="stylesheet" href="{{ asset('gentelella/assets/cssPresentation/service.css') }}">
@endsection
@section('content')
<header>
  <div class="container">
    <div class="header_wrapper">
      <div class="header_nav">
        <a href="#" class="nav_logo">
          <!--<img src="{{ asset('gentelella/assets/cssPresentation/Idocs Mali.png') }}" alt="Logo IDOCS MALI"
              class="logo" width="100" height="100">-->
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

    <h1 style="text-decoration:none;color:#2c7be5">Demande d'extrait d'acte de naissance:</h1> <br>
    <h3 style="color: #2c7be5;">PROCEDURES ET DELIVRANCE:</h3>
    <br>
    <p>
    <ul style="margin-left: 30px;">

      <li style="margin-bottom: 10px;">
        L’hôpital, la clinique, ou la maternité enregistre la naissance dans un registre d’état Civil et transmet un
        volet (II) dit de déclaration de naissance à la mairie ou au Centre d’état civil dont il ou elle dépend.
      </li>
      <li style="margin-bottom: 10px;">
        L’hôpital, la clinique ou la maternité remet à l’usager le numéro du volet de la déclaration de naissance qui à
        son tour le présente à la section état civil où le volet de la déclaration de naissance a été transmis.
      </li>
      <li style="margin-bottom: 10px;">
        L’agent de la section d’état civil procède à l’enregistrement des informations contenues dans le volet. Cette
        opération est appelée transcription.
      </li>
      <li style="margin-bottom: 10px;">
        L’usager vérifie l’exactitude des informations enregistrées.
      </li>
      <li style="margin-bottom: 10px;">
        L’extrait d’acte de naissance, dit volet III, est soumis à la signature du maire avant d’être remis à l’usager
        qui pourra en faire des copies.
      </li>
      <li style="margin-bottom: 10px;">
        Les parents ont un délai maximum de 1 mois (30 jours francs) pour déclarer la naissance de leur enfant. Passé ce
        délai, il faudra recourir à un jugement supplétif.
      </li>
      <li style="margin-bottom: 10px;">
        L’extrait d’acte de naissance est une formule manuscrite. C’est sa copie qui est saisie à la machine.
      </li>
    </ul>
    </p>
    <br>
    <h3 style="color: #2c7be5;">DOCUMENT FOURNIR :</h3>
    <br>
    <p>
    <ul style="margin-left: 30px;">
      <li style="margin-bottom: 10px;">
        Volet de déclaration de naissance de l’hôpital, la clinique ou la maternité pour obtenir l’extrait d’acte de
        naissance.
      </li>
      <li>
        L’extrait d’acte de naissance dit volet III pour obtenir une ou des copies de l’extrait d’acte de naissance.
      </li>
    </ul>
    </p>
    <br>
    <h3 style="color: #2c7be5;">COUT LEGAL :</h3><br>
    <p>
    <ul style="margin-left: 30px;">
      <li style="margin-bottom: 10px;">Gratuit pour l’extrait d’acte de naissance (volet III)</li>
      <li>100 FCFA pour la copie sur l'ensemble du territoire. La copie peut se faire dans n'importe quel centre d'état
        civil.</li>
    </ul>
    </p>
    <br>
    <h3 style="color: #2c7be5;">DELAI D'OBTENTION :</h3><br>
    <p>
      Généralement délivré sous 24 heures à partir de la réception du dossier par l'état civil.
    </p>
    <br>
    <h3 style="color: #2c7be5;">REFERENCES :</h3><br>
    <p>
      Articles 74 à 79 de la loi n°06‐024 du 28 juin 2006 régissant l’Etat Civil (pour l’Extrait d’acte de naissance) et
      Articles 63, 64, 65 de la loi n°06‐024 (pour la copie).
    </p>
    <br>
    <h3 style="color: #2c7be5;">SERVICE A CONTACTER :</h3><br>
    <p>
      Centre d'état civil du lieu de résidence
    </p>
  </div>

</section>
@endsection