@extends('layouts.app')
@section('titre')Détails @endsection
@section('content')

<div class="btn-return text-center mb-4">
  <a href="{{ route('hopital.dashboard') }}" class="btn btn-outline-secondary rounded-pill">
    <i class="fa fa-arrow-left"></i> Retour à la liste
  </a>
</div>

<div class="flex flex-col lg:flex-row gap-6 p-6">
  <!-- TICKET À GAUCHE -->
  <div
    class="bg-white shadow-md rounded-md p-6 w-full lg:w-1/3 print:w-full print:mb-6 self-start flex flex-col justify-between">
    <div>
      <h2 class="text-center font-semibold text-lg border-b pb-2 mb-4">Ticket de Déclaration</h2>

      <ul class="space-y-2 text-sm text-gray-700">
        <li><strong>Nom :</strong> {{ $declaration->declarant->nom_declarant }}</li>
        <li><strong>Prénom :</strong> {{ $declaration->declarant->prenom_declarant }}</li>
        <li><strong>Adresse :</strong> {{ $declaration->declarant->domicile_declarant }}</li>
        <li><strong>Téléphone :</strong> {{ $declaration->declarant->telephone ?? '---' }}</li>
        <li><strong>Email :</strong> {{ $declaration->declarant->email ?? '---' }}</li>
        <li><strong>N° Volet :</strong> <span class="text-red-600 font-semibold">{{ $declaration->num_volet }}</span>
        </li>
        <li><strong>Hôpital :</strong> {{ $declaration->hopital->nom_hopital }}</li>
        <li class="pt-4">Signature / Cachet : _______________________</li>
      </ul>

      <div class="mt-6 text-right print:hidden">
        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          🖨️ Imprimer
        </button>
      </div>
    </div>

    <div class="mt-6 print:hidden">
      @if(!$demandeExistante)
      <button id="openModalBtn" type="button" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
        <i class="fa fa-paper-plane"></i> Envoyer demande à la mairie
      </button>
      @else
      <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded w-full" disabled>
        <i class="fa fa-paper-plane"></i> Demande déjà envoyée
      </button>
      <div class="text-red-600 mt-2 text-sm">Une demande a déjà été envoyée pour ce volet.</div>
      @endif
    </div>
  </div>

  <!-- VOLET À DROITE -->
  <div class="bg-white shadow-md rounded-md p-6 w-full lg:w-2/3 print:w-full">
    <div class="text-center mb-4">
      <h3 class="font-bold uppercase">République du Mali</h3>
      <p class="text-sm text-gray-600">Un Peuple - Un But - Une Foi</p>
    </div>

    <div class="grid grid-cols-2 gap-4 text-sm text-gray-800">
      <div>RÉGION : {{ $declaration->hopital->commune->region ?? '---' }}</div>
      <div>CERCLE : {{ $declaration->hopital->commune->cercle ?? '---' }}</div>
      <div class="col-span-2">COMMUNE : {{ $declaration->hopital->commune->nom_commune }}</div>
      <div class="col-span-2">CENTRE DE DÉCLARATION : {{ $declaration->hopital->nom_hopital ?? '---' }}</div>
    </div>

    @if($declaration->token)
    <div class="mt-4 d-flex justify-content-right">
      <div style="border:2px solid #0d6efd; border-radius:12px; padding:20px; background:#f8f9fa; max-width:320px;">
        <div class="text-center mb-2">
          <span style="font-size:12px; color:#0d6efd; font-weight:bold;">Vérification d'authenticité</span>
        </div>
        <div class="text-center mb-2">
          {!! QrCode::size(90)->generate(url('/verifier-document/' . $declaration->token)) !!}
        </div>
        <div class="text-center" style="font-size:0.95em; color:#333;">
          <span>Scannez ce QR code pour vérifier l'authenticité du volet.</span>
        </div>
      </div>
    </div>
    @endif

    <hr class="my-4 border-gray-300">

    <h4 class="font-semibold text-blue-600 text-md mb-2">Volet N°2 – Ministère de l’Administration Territoriale</h4>
    <p class="mb-4 text-center text-lg font-bold text-red-600">Déclaration N° : {{ $declaration->num_volet }}</p>

    <!-- Infos Enfant -->
    <div class="mb-6">
      <h5 class="font-semibold text-gray-700 mb-2">Informations sur l’Enfant</h5>
      <div class="grid grid-cols-2 gap-2 text-sm">
        <div>1. Date de naissance : {{ \Carbon\Carbon::parse($declaration->date_naissance)->translatedFormat('d F Y') }}
        </div>
        <div>2. Heure : {{ $declaration->heure_naissance }}</div>
        <div class="col-span-2">3. Date de déclaration : {{
          \Carbon\Carbon::parse($declaration->date_declaration)->translatedFormat('d F Y') }}</div>
        <div>4. Prénoms : {{ $declaration->prenom_enfant }}</div>
        <div>5. Nom : {{ $declaration->nom_enfant }}</div>
        <div>6. Sexe : {{ $declaration->sexe === 'M' ? 'Masculin' : 'Féminin' }}</div>
        <div>7. Nombre d’enfants : {{ $declaration->nbreEnfantAccouchement }}</div>
        <div>8. Lieu de naissance : {{ $declaration->hopital->commune->region ?? '---' }}</div>
        <div>9. Lieu d’accouchement : {{ $declaration->hopital->nom_hopital ?? '---' }}</div>
      </div>
    </div>

    <!-- Infos Père -->
    <div class="mb-6">
      <h5 class="font-semibold text-gray-700 mb-2">Informations sur le Père</h5>
      <div class="grid grid-cols-2 gap-2 text-sm">
        <<<<<<< HEAD <div>10. Prénom et Nom : {{ $declaration->prenom_pere }} {{ $declaration->nom_pere }}
      </div>
      =======
      <div>10. Nom : {{ $declaration->prenom_pere }} {{ $declaration->nom_pere }}</div>
      >>>>>>> 6fe73e6793f2e6aec92660669b1b3f3cb7f69410
      <div>11. Âge : {{ $declaration->age_pere }}</div>
      <div>12. Domicile : {{ $declaration->domicile_pere }}</div>
      <div>13. Ethnie : {{ $declaration->ethnie_pere }}</div>
      <div>14. Situation matrimoniale : {{ $declaration->situation_matrimonial_pere }}</div>
      <div>15. Instruction : {{ $declaration->niveau_instruction_pere }}</div>
      <div class="col-span-2">16. Profession : {{ $declaration->profession_pere }}</div>
    </div>
  </div>

  <!-- Infos Mère -->
  <div class="mb-6">
    <h5 class="font-semibold text-gray-700 mb-2">Informations sur la Mère</h5>
    <div class="grid grid-cols-2 gap-2 text-sm">
      <<<<<<< HEAD <div>17. Prénom et Nom : {{ $declaration->prenom_mere }} {{ $declaration->nom_mere }}
    </div>
    =======
    <div>17. Nom : {{ $declaration->prenom_mere }} {{ $declaration->nom_mere }}</div>
    >>>>>>> 6fe73e6793f2e6aec92660669b1b3f3cb7f69410
    <div>18. Âge : {{ $declaration->age_mere }}</div>
    <div>19. Domicile : {{ $declaration->domicile_mere }}</div>
    <div>20. Ethnie : {{ $declaration->ethnie_mere }}</div>
    <div>21. Situation matrimoniale : {{ $declaration->situation_matrimonial_mere }}</div>
    <div>22. Enfants vivants : {{ $declaration->nbreEINouvNee }}</div>
    <div>23. Instruction : {{ $declaration->niveau_instruction_mere }}</div>
    <div>24. Profession : {{ $declaration->profession_mere }}</div>
  </div>
</div>

<!-- Infos Déclarant -->
<div class="mb-6">
  <h5 class="font-semibold text-gray-700 mb-2">🧾 Informations sur le Déclarant</h5>
  <div class="grid grid-cols-2 gap-2 text-sm">
    <div>25. Nom : {{ $declaration->declarant->prenom_declarant }} {{ $declaration->declarant->nom_declarant }}</div>
    <div>26. Âge : {{ $declaration->declarant->age_declarant }}</div>
    <div class="col-span-2">27. Domicile : {{ $declaration->declarant->domicile_declarant }}</div>
  </div>
</div>

<!-- Agent -->
<div class="mb-6 text-center text-sm">
  <h5 class="font-semibold">Agent de Déclaration</h5>
  <p>{{ Auth::user()->prenom ?? '---' }} {{ Auth::user()->nom }}</p>
</div>

<!-- Signatures -->
<div class="grid grid-cols-2 gap-4 mt-6 text-sm text-center">
  <div>Signature du déclarant : ____________________</div>
  <div>Signature de l’agent : ______________________</div>
</div>
</div>
</div>

<!-- Modal, styles, JS peuvent suivre si tu le souhaites -->


<!-- MODALE -->
<div id="modalEditDemande" class="modal-custom-overlay" style="display:none;">
  <div class="modal-custom-content" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <form action="{{ route('hopital.demandes.envoyer', $declaration->id_volet) }}" method="POST">
      @csrf
      <div class="modal-custom-header">
        <h5 id="modalTitle" style="margin:0; font-size:1.2rem; color:#2563eb;">Éditer la demande avant envoi</h5>
        <button type="button" class="modal-custom-close" id="closeModalBtn" aria-label="Fermer">&times;</button>
      </div>
      <div class="modal-custom-body">
        <div class="mb-3">
          <label for="nom_complet" class="form-label">Nom complet du déclarant</label>
          <input type="text" class="form-control" id="nom_complet" name="nom_complet"
            value="{{ $declaration->declarant->nom_declarant }} {{ $declaration->declarant->prenom_declarant }}"
            required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ $declaration->declarant->email }}">
        </div>
        <div class="mb-3">
          <label for="telephone" class="form-label">Téléphone</label>
          <input type="text" class="form-control" id="telephone" name="telephone"
            value="{{ $declaration->declarant->telephone }}">
        </div>
        <div class="mb-3">
          <label for="nombre_copies" class="form-label">Nombre de copies</label>
          <input type="number" class="form-control" id="nombre_copies" name="nombre_copies" value="1" min="1">
        </div>
        <div class="mb-3">
          <label for="message_hopital" class="form-label">Message à la mairie</label>
          <textarea class="form-control" id="message_hopital" name="message_hopital"
            rows="2">Demande d'acte de naissance initiée par l'hôpital pour le volet N° {{ $declaration->num_volet }}</textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Mairie destinataire</label>
          <input type="text" class="form-control"
            value="{{ isset($mairieCommune) ? $mairieCommune->nom_mairie : 'Aucune mairie trouvée' }}" disabled>
          <input type="hidden" name="id_mairie" value="{{ isset($mairieCommune) ? $mairieCommune->id : '' }}">
        </div>
      </div>
      <div class="modal-custom-footer">
        <button type="button" class="btn-cancel" id="cancelModalBtn">Annuler</button>
        <button type="submit" class="btn-submit">Envoyer la demande</button>
      </div>
    </form>
  </div>
</div>

<!-- STYLES -->
<style>
  .modal-custom-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.45);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(2px);
    animation: fadeIn 0.3s;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  .modal-custom-content {
    background: #fff;
    border-radius: 18px;
    max-width: 400px;
    width: 95%;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.22);
    animation: slideDown 0.3s;
  }

  @keyframes slideDown {
    from {
      transform: translateY(-40px);
      opacity: 0;
    }

    to {
      transform: translateY(0);
      opacity: 1;
    }
  }

  .modal-custom-header,
  .modal-custom-footer {
    padding: 20px 28px;
    border-bottom: 1px solid #f0f0f0;
  }

  .modal-custom-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 18px 18px 0 0;
    background: #f8fafc;
  }

  .modal-custom-footer {
    display: flex;
    justify-content: flex-end;
    border-top: 1px solid #f0f0f0;
    border-bottom: none;
    border-radius: 0 0 18px 18px;
    background: #f8fafc;
  }

  .modal-custom-close {
    font-size: 2rem;
    cursor: pointer;
    color: #2563eb;
    transition: color 0.2s;
    background: none;
    border: none;
    line-height: 1;
  }

  .modal-custom-close:hover {
    color: #ef4444;
  }

  .btn-cancel,
  .btn-submit {
    padding: 10px 22px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    font-size: 1rem;
    margin-left: 8px;
    transition: background 0.2s, color 0.2s;
  }

  .btn-cancel {
    background: #f3f4f6;
    color: #374151;
  }

  .btn-cancel:hover {
    background: #e5e7eb;
  }

  .btn-submit {
    background: #2563eb;
    color: white;
  }

  .btn-submit:hover {
    background: #1d4ed8;
  }

  .modal-custom-body .form-label {
    font-weight: 500;
    color: #2563eb;
  }

  .modal-custom-body input,
  .modal-custom-body textarea {
    margin-bottom: 10px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    padding: 8px 10px;
    width: 100%;
    font-size: 1rem;
    transition: border 0.2s;
  }

  .modal-custom-body input:focus,
  .modal-custom-body textarea:focus {
    border: 1.5px solid #2563eb;
    outline: none;
  }

  @media (max-width: 600px) {
    .modal-custom-content {
      max-width: 98vw;
    }

    .modal-custom-header,
    .modal-custom-footer {
      padding: 14px 10px;
    }
  }
</style>

<!-- JS -->
<script>
  // Ouverture du modal
const openBtn = document.getElementById('openModalBtn');
const modal = document.getElementById('modalEditDemande');
const closeBtn = document.getElementById('closeModalBtn');
const cancelBtn = document.getElementById('cancelModalBtn');

function openModal() {
  modal.style.display = 'flex';
  setTimeout(() => {
    const firstInput = modal.querySelector('input,textarea,select');
    if(firstInput) firstInput.focus();
  }, 100);
}
function closeModal() {
  modal.style.display = 'none';
}
openBtn?.addEventListener('click', openModal);
closeBtn?.addEventListener('click', closeModal);
cancelBtn?.addEventListener('click', function(e) {
  e.preventDefault();
  closeModal();
});
document.addEventListener('keydown', function(e) {
  if (modal.style.display === 'flex' && e.key === "Escape") closeModal();
});
// Loader sur le bouton d'envoi
modal.querySelector('form')?.addEventListener('submit', function(e) {
  const btn = this.querySelector('.btn-submit');
  btn.disabled = true;
  btn.innerHTML = 'Envoi...';
});
</script>
@endsection