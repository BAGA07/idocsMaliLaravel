<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Acte de Naissance - PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .section { margin-bottom: 20px; }
        .cachet { width: 100px; }
        .signature { width: 200px; border: 1px solid #ccc; }
        .infos { margin-bottom: 10px; }
    </style>
</head>
<body>
   <div
    class="max-w-3xl mx-auto bg-white border border-black p-6 text-[16px] font-[Times New Roman] print:p-4 print:w-full print:max-w-full print:border-none print-acte-singlepage"
    style="break-inside: avoid; page-break-inside: avoid;">

    <!-- En-tête avec logo et slogan -->
    <div class="flex justify-between items-start mb-4">
        {{-- <img src="images/logo_mali.png" alt="Logo Mali" class="w-24 h-auto"> --}}
        <div class="text-center flex-1">
            <p class="uppercase font-bold">République du Mali</p>
            <p><em>Un Peuple - Un But - Une Foi</em></p>
        </div>
        {{-- <img src="images/tampon_officiel.png" alt="Tampon Officiel" class="w-24 h-auto"> --}}
    </div>

    <!-- Infos de localisation et numéro d'acte -->
    <div class="grid grid-cols-2 gap-2 border border-black p-2">
        <div>
            <p><strong>RÉGION DE :</strong> {{ str_replace(['/', '\\'], '', optional($acte->Commune)->region ?? '...') }}</p>
            <p><strong>CERCLE DE :</strong> {{ str_replace(['/', '\\'], '', optional($acte->Commune)->cercle ?? '...') }}</p>
            <p><strong>COMMUNE DE :</strong> {{ str_replace(['/', '\\'], '', optional($acte->Commune)->nom_commune ?? '...') }}</p>
            <p><strong>CENTRE :</strong> Principal</p>
            <p><strong>DE :</strong> La Commune IV</p>
        </div>
        <div class="text-right">
            <p><strong>Acte de naissance</strong> N° {{ $acte->num_acte }}</p>
            <p class="text-sm">(Volet N°3 – Original remis au déclarant)</p>
            <p><strong>NINA :</strong> ......................................</p>
        </div>
    </div>

    <!-- Infos enfant -->
    <div class="border border-black mt-3 p-2">
        <p><strong>1. Date de naissance :</strong> {{
            \Carbon\Carbon::parse($acte->date_naissance_enfant)->translatedFormat('d F Y') }}</p>
        <p><strong>2. Heure de naissance :</strong> {{ $acte->heure_naissance ?? '...' }}</p>
        <p><strong>3. Prénom(s) :</strong> {{ str_replace(['/', '\\'], '', $acte->prenom) }}</p>
        <p><strong>4. Nom :</strong> {{ str_replace(['/', '\\'], '', $acte->nom) }}</p>
        <p><strong>5. Sexe :</strong> {{ $acte->sexe_enfant }}</p>
        <p><strong>6. Lieu de naissance :</strong> {{ str_replace(['/', '\\'], '', $acte->lieu_naissance_enfant) }}</p>
    </div>

    <!-- Infos père -->
    <div class="border border-black mt-3 p-2">
        <p><strong>7. Nom du père :</strong> {{ str_replace(['/', '\\'], '', $acte->nom_pere) }}</p>
        {{-- {{ dd($acte->demande->volet) }} --}}
        <p><strong>8. Âge :</strong> {{ optional(optional($acte->demande)->volet)->age_pere ?? '...' }} ans</p>
        <p><strong>9. Domicile :</strong> {{ str_replace(['/', '\\'], '', $acte->domicile_pere) }}</p>
        <p><strong>10. Profession :</strong> {{ str_replace(['/', '\\'], '', $acte->profession_pere) }}</p>
    </div>

    <!-- Infos mère -->
    <div class="border border-black mt-3 p-2">
        <p><strong>11. Nom de la mère :</strong> {{ str_replace(['/', '\\'], '', $acte->nom_mere) }}</p>
        <p><strong>12. Âge :</strong> {{ optional(optional($acte->demande)->volet)->age_mere ?? '...' }} ans</p>
        <p><strong>13. Domicile :</strong> {{ str_replace(['/', '\\'], '', $acte->domicile_mere) }}</p>
        <p><strong>14. Profession :</strong> {{ str_replace(['/', '\\'], '', $acte->profession_mere) }}</p>
    </div>

    <!-- Infos déclarant -->
    <div class="border border-black mt-3 p-2">
        <p><strong>15. Déclarant :</strong> {{ str_replace(['/', '\\'], '', optional($acte->declarant)->nom_declarant ?? '...') }}</p>
        <p><strong>16. Âge :</strong> {{ optional($acte->declarant)->age_declarant ?? '...' }} ans</p>
        <p><strong>17. Domicile :</strong> {{ str_replace(['/', '\\'], '', optional($acte->declarant)->domicile_declarant ?? '...') }}</p>
        <p><strong>18. Profession :</strong> {{ str_replace(['/', '\\'], '', optional($acte->declarant)->profession_declarant ?? '...') }}</p>
    </div>

    <!-- Infos enregistrement -->
    <div class="border border-black mt-3 p-2">
        <p><strong>19. N° de déclaration et date :</strong> {{ str_replace(['/', '\\'], '', optional($acte->declarant)->numero_declaration ?? '...') }} du {{
            optional($acte->declarant)->date_declaration ? \Carbon\Carbon::parse(optional($acte->declarant)->date_declaration)->format('d/m/Y') : '...' }}</p>
        <p><strong>20. Centre :</strong> {{ str_replace(['/', '\\'], '', $acte->lieu_naissance_enfant) }}</p>
    </div>

    <!-- Officier état civil -->
    <div class="border border-black mt-3 p-2">
        <p><strong>21. Officier d'état civil :</strong> {{ str_replace(['/', '\\'], '', optional($acte->officier)->nom ?? '...') }}</p>
        {{-- {{ $acte->officier->Mairie->nom_mairie ?? '...' }} --}}
        <p><strong>22. Qualité :</strong> {{ str_replace(['/', '\\'], '', optional($acte->officier)->profession ?? '...') }} </p>
        <p><strong>23. Date :</strong> {{ \Carbon\Carbon::parse($acte->date_enregistrement_acte)->format('d/m/Y') }}</p>
    </div>

    <!-- Signature + Tampon officiel -->
    <div class="mt-10 relative h-32 print-pagebreak-avoid">
        <p class="text-right font-semibold">24. Signature et cachet de l'officier d'état civil</p>
        @if($acte->statut === 'Finalisé')
            <div class="flex flex-row items-end justify-end mt-2 gap-4" style="align-items: center;">
                @if($acte->signature_image)
                    <img src="{{ str_replace(['/', '\\'], '', $acte->signature_image) }}" alt="Signature Officier" style="width:120px; border:1px solid #ccc; align-self:center; margin-bottom:0; margin-top:0;">
                @endif
                @if($acte->cachet_applique)
                    <img src="images/cacher.png" alt="Cachet" style="width:140px;">
                @endif
            </div>
        @endif
    </div>
    
    <div class="section">
        <strong>Finalisé par :</strong> {{ str_replace(['/', '\\'], '', optional($acte->officier)->prenom ?? '') }} {{ str_replace(['/', '\\'], '', optional($acte->officier)->nom ?? '') }}<br>
        <strong>Date de signature :</strong> {{ $acte->signed_at ? \Carbon\Carbon::parse($acte->signed_at)->format('d/m/Y H:i') : '' }}
    </div>
    
    <div class="section">
        <button onclick="window.print()" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Imprimer</button>
    </div>

    @if($acte->token)
    <div style="margin-top:40px; text-align:center;">
        <div style="display:inline-block; padding:0;">
            <div style="font-size:1.1em; color:#222; font-weight:bold; margin-bottom:8px;">Vérification d'authenticité</div>
            <div style="margin-bottom:8px;">
                {!! QrCode::size(120)->generate(url('/verifier-document/' . $acte->token)) !!}
            </div>
            <div style="font-size:0.95em; color:#222;">Scannez ce QR code pour vérifier l'authenticité de cet acte de naissance.</div>
        </div>
    </div>
    @endif
</div>
</body>
</html> 