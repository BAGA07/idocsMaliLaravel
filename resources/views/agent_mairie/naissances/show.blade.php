@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6">

    {{-- Bouton retour --}}
    <a href="{{ route('agent.dashboard') }}" class="inline-block text-blue-600 hover:underline mb-4">&larr; Retour au dashboard</a>

    {{-- En‑tête --}}
    <div class="text-center mb-6">
        <h5 class="font-bold uppercase">République du Mali</h5>
        <p class="italic">Un Peuple – Un But – Une Foi</p>
        <h4 class="text-xl font-semibold mb-1">Acte de naissance N° {{ $acte->num_acte }}</h4>
        <h6 class="text-sm text-gray-600">(Volet N°3 – Original remis au déclarant)</h6>
    </div>

    {{-- Informations géographiques --}}
    <div class="border p-4 rounded mb-6">
        <p><strong>Région :</strong> {{ $acte->Commune->region ?? 'N/A' }}</p>
        <p><strong>Cercle :</strong> {{ $acte->Commune->cercle ?? 'N/A' }}</p>
        <p><strong>Commune :</strong> {{ $acte->Commune->nom_commune ?? 'N/A' }}</p>
    </div>

    {{-- Section enfant --}}
    <div class="mb-6">
        <h5 class="font-semibold mb-2">Enfant</h5>
        <div class="space-y-1 border p-4 rounded bg-gray-50">
            <p><strong>Nom :</strong> {{ $acte->nom }}</p>
            <p><strong>Prénom :</strong> {{ $acte->prenom }}</p>
            <p><strong>Date de naissance :</strong> {{ $acte->date_naissance_enfant }}</p>
            <p><strong>Heure :</strong> {{ $acte->heure_naissance ?? 'Non précisée' }}</p>
            <p><strong>Lieu :</strong> {{ $acte->lieu_naissance_enfant }}</p>
            <p><strong>Sexe :</strong> {{ $acte->sexe_enfant }}</p>
        </div>
    </div>

    {{-- Section père --}}
    <div class="mb-6">
        <h5 class="font-semibold mb-2">Père</h5>
        <div class="space-y-1 border p-4 rounded bg-gray-50">
            <p><strong>Nom :</strong> {{ $acte->nom_pere }}</p>
            <p><strong>Prénom :</strong> {{ $acte->prenom_pere }}</p>
            <p><strong>Profession :</strong> {{ $acte->proffesion_pere }}</p>
            <p><strong>Domicile :</strong> {{ $acte->domicile_pere }}</p>
        </div>
    </div>

    {{-- Section mère --}}
    <div class="mb-6">
        <h5 class="font-semibold mb-2">Mère</h5>
        <div class="space-y-1 border p-4 rounded bg-gray-50">
            <p><strong>Nom :</strong> {{ $acte->nom_mere }}</p>
            <p><strong>Prénom :</strong> {{ $acte->prenom_mere }}</p>
            <p><strong>Profession :</strong> {{ $acte->proffesion_mere }}</p>
            <p><strong>Domicile :</strong> {{ $acte->domicile_mere }}</p>
        </div>
    </div>

    {{-- Déclarant --}}
    <div class="mb-6">
        <h5 class="font-semibold mb-2">Déclarant</h5>
        <div class="space-y-1 border p-4 rounded bg-gray-50">
            <p><strong>Nom :</strong> {{ $acte->declarant->nom_declarant ?? 'N/A' }}</p>
            <p><strong>Prénom :</strong> {{ $acte->declarant->prenom_declarant ?? '' }}</p>
            <p><strong>Profession :</strong> {{ $acte->declarant->profession_declarant ?? 'N/A' }}</p>
            <p><strong>Domicile :</strong> {{ $acte->declarant->domicile_declarant ?? 'N/A' }}</p>
        </div>
    </div>

    {{-- Infos juridiques --}}
    <div class="mb-6">
        <h5 class="font-semibold mb-2">Informations juridiques</h5>
        <div class="space-y-1 border p-4 rounded bg-gray-50">
            <p><strong>Date d'enregistrement :</strong> {{ $acte->date_enregistrement_acte }}</p>
            <p><strong>Officier d'état civil :</strong> {{ $acte->officier->nom ?? 'N/A' }}</p>
        </div>
    </div>

    {{-- Signature --}}
    <div class="text-right mb-8">
        <p><strong>Fait à :</strong> {{ $acte->lieu_naissance_enfant }}</p>
        <p><strong>Le :</strong> {{ \Carbon\Carbon::parse($acte->date_enregistrement_acte)->format('d/m/Y') }}</p>
        <p class="mt-8">Signature et cachet de l’officier d’état civil</p>
    </div>
    <div class="mt-4">
        <img src="{{ asset('images/signature_cachet.png') }}" alt="Cachet ou Signature" class="inline-block h-20">
    </div>
</div>


    {{-- Bouton PDF --}}
    <div class="text-center mb-4">
        <a href="{{ route('acte.pdf', $acte->id) }}" target="_blank"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
           Télécharger l'acte (PDF)
        </a>
    </div>

    {{-- QR code d'authenticité --}}
    @if($acte->token)
    <div class="flex justify-center mb-6">
        <div class="border-2 border-blue-600 rounded-lg p-6 bg-gray-100">
            <p class="text-center font-semibold text-blue-600 mb-2">Vérification d'authenticité</p>
            <div class="flex justify-center mb-4">
                {!! QrCode::size(120)->generate(url('/verifier-document/' . $acte->token)) !!}
            </div>
            <p class="text-center text-gray-600 text-sm">Scannez ce QR code pour vérifier l'authenticité de cet acte de naissance.</p>
        </div>
    </div>
    @endif

    {{-- Suppression --}}
    <form action="{{ route('acte.destroy', $acte->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet acte ?');" class="text-center">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">
            Supprimer cet acte
        </button>
    </form>

</div>
@endsection
