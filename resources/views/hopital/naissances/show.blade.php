@extends('layouts.app')
@section('titre')Détails @endsection
@section('content')

@if(session('success'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
  </div>
@endif
@if(session('error'))
  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
    {{ session('error') }}
  </div>
@endif

<div class="text-center mb-4">
  <a href="{{ route('hopital.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-200">
    <i class="fa fa-arrow-left mr-2"></i> Retour à la liste
  </a>
</div>

<div class="flex flex-col lg:flex-row gap-6 p-6">
  <!-- TICKET À GAUCHE -->
    <div class="bg-white shadow-md rounded-md p-6 w-full lg:w-1/3 print:w-full print:mb-6 self-start flex flex-col justify-between">
    <div>
      <h2 class="text-center font-semibold text-lg border-b pb-2 mb-4">Ticket de Déclaration</h2>

      <ul class="space-y-2 text-sm text-gray-700">
        <li><strong>Nom :</strong> {{ $declaration->declarant->nom_declarant }}</li>
        <li><strong>Prénom :</strong> {{ $declaration->declarant->prenom_declarant }}</li>
        <li><strong>Adresse :</strong> {{ $declaration->declarant->domicile_declarant }}</li>
        <li><strong>Téléphone :</strong> {{ $declaration->declarant->telephone ?? '---' }}</li>
        <li><strong>Email :</strong> {{ $declaration->declarant->email ?? '---' }}</li>
                <li><strong>N° Volet :</strong> <span class="text-red-600 font-semibold">{{ $declaration->num_volet }}</span></li>
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
            <!-- Nouveau bouton d'ouverture du modal -->
      @if(!$demandeExistante)
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full" type="button">
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
  <div class="bg-white shadow-md rounded-md p-6 w-full lg:w-2/3 print:w-full relative">
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
        <div class="absolute top-4 right-4">
          {!! QrCode::size(90)->generate(url('/verifier-document/' . $declaration->token)) !!}
    </div>
    @endif

    <hr class="my-4 border-gray-300">

    <h4 class="font-semibold text-blue-600 text-md mb-2">Volet N°2 – Ministère de l’Administration Territoriale</h4>
    <p class="mb-4 text-center text-lg font-bold text-red-600">Déclaration N° : {{ $declaration->num_volet }}</p>

    <!-- Infos Enfant -->
    <div class="mb-6">
      <h5 class="font-semibold text-gray-700 mb-2">Informations sur l’Enfant</h5>
      <div class="grid grid-cols-2 gap-2 text-sm">
                <div>1. Date de naissance : {{ \Carbon\Carbon::parse($declaration->date_naissance)->translatedFormat('d F Y') }}</div>
        <div>2. Heure : {{ $declaration->heure_naissance }}</div>
                <div class="col-span-2">3. Date de déclaration : {{ \Carbon\Carbon::parse($declaration->date_declaration)->translatedFormat('d F Y') }}</div>
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
                <div>10. Prénom et Nom : {{ $declaration->prenom_pere }} {{ $declaration->nom_pere }}</div>
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
                <div>17. Prénom et Nom : {{ $declaration->prenom_mere }} {{ $declaration->nom_mere }}</div>
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

<!-- Nouveau modal Flowbite -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    Éditer la demande avant envoi
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Fermer le modal</span>
                </button>
            </div>
            <form class="p-4 md:p-5" action="{{ route('hopital.demandes.envoyer', $declaration->id_volet) }}" method="POST">
      @csrf
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div>
                        <label for="nom_complet" class="block mb-2 text-sm font-medium text-blue-700">Nom complet du déclarant</label>
                        <input type="text" name="nom_complet" id="nom_complet" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" value="{{ $declaration->declarant->nom_declarant }} {{ $declaration->declarant->prenom_declarant }}" required>
      </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-blue-700">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" value="{{ $declaration->declarant->email }}">
        </div>
                    <div>
                        <label for="telephone" class="block mb-2 text-sm font-medium text-blue-700">Téléphone</label>
                        <input type="text" name="telephone" id="telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" value="{{ $declaration->declarant->telephone }}">
        </div>
                    <div>
                        <label for="nombre_copies" class="block mb-2 text-sm font-medium text-blue-700">Nombre de copies</label>
                        <input type="number" name="nombre_copies" id="nombre_copies" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" value="1" min="1">
        </div>
                    <div>
                        <label for="message_hopital" class="block mb-2 text-sm font-medium text-blue-700">Message à la mairie</label>
                        <textarea id="message_hopital" name="message_hopital" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-600 focus:border-blue-600" placeholder="Message à la mairie">Demande d'acte de naissance initiée par l'hôpital pour le volet N° {{ $declaration->num_volet }}</textarea>
        </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-blue-700">Mairie destinataire</label>
                        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" value="{{ isset($mairieCommune) ? $mairieCommune->nom_mairie : 'Aucune mairie trouvée' }}" disabled>
          <input type="hidden" name="id_mairie" value="{{ isset($mairieCommune) ? $mairieCommune->id : '' }}">
        </div>
      </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Envoyer la demande
                </button>
    </form>
        </div>
  </div>
</div>

<!-- STYLES -->
<style>
  .modal-custom-overlay {
  position: fixed; top:0; left:0; right:0; bottom:0;
  background: rgba(0,0,0,0.45);
    z-index: 1000;
  display: flex; align-items: center; justify-content: center;
    backdrop-filter: blur(2px);
    animation: fadeIn 0.3s;
  }
  @keyframes fadeIn {
  from { opacity: 0; }
  to   { opacity: 1; }
  }
  .modal-custom-content {
    background: #fff;
    border-radius: 18px;
    max-width: 400px;
  width: 95vw;
  box-shadow: 0 12px 40px rgba(0,0,0,0.22);
    animation: slideDown 0.3s;
  max-height: 90vh;
  overflow-y: visible;
  text-align: justify;
  margin: 0 8px;
  }
  @keyframes slideDown {
  from { transform: translateY(-40px); opacity: 0; }
  to   { transform: translateY(0); opacity: 1; }
  }
.modal-custom-header, .modal-custom-footer {
    padding: 20px 28px;
    border-bottom: 1px solid #f0f0f0;
  }
  .modal-custom-header {
  display: flex; justify-content: space-between; align-items: center;
    border-radius: 18px 18px 0 0;
    background: #f8fafc;
  }
  .modal-custom-footer {
  display: flex; justify-content: flex-end; border-top: 1px solid #f0f0f0;
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
.btn-cancel, .btn-submit {
    padding: 10px 22px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    font-size: 1rem;
    margin-left: 8px;
    transition: background 0.2s, color 0.2s;
  }
.btn-cancel { background: #f3f4f6; color: #374151; }
.btn-cancel:hover { background: #e5e7eb; }
.btn-submit { background: #2563eb; color: white; }
.btn-submit:hover { background: #1d4ed8; }
  .modal-custom-body .form-label {
  font-weight: 600;
    color: #2563eb;
  margin-bottom: 4px;
  display: block;
  }
  .modal-custom-body input,
  .modal-custom-body textarea {
  margin-bottom: 16px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
  padding: 10px 12px;
    width: 100%;
    font-size: 1rem;
    transition: border 0.2s;
  background: #f9fafb;
  }
  .modal-custom-body input:focus,
  .modal-custom-body textarea:focus {
    border: 1.5px solid #2563eb;
    outline: none;
  background: #fff;
  }
  @media (max-width: 600px) {
    .modal-custom-content {
    max-width: 100vw;
    width: 100vw;
    margin: 0;
    border-radius: 0;
    padding-left: 0; padding-right: 0;
  }
  .modal-custom-header, .modal-custom-footer {
    padding: 12px 6px;
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
  if(openBtn) openBtn.disabled = true;
});
</script>
@endsection
