@if(isset($data['message']))
    {!! nl2br(e($data['message'])) !!}
@else
Bonjour {{ $data['nom_declarant'] }},

Nous vous informons que votre déclaration de naissance (numéro de volet : {{ $data['num_volet'] }}) pour l’enfant {{ $data['nom_enfant'] }}, né(e) le {{ $data['date_naissance'] }}, a été **rejetée** par  la {{ $data['hopital'] }} en date du {{ $data['date_rejet'] }}.

**Motif du rejet :** {{ $data['motif_rejet'] }}

Nous vous invitons à corriger les informations ou à fournir les documents nécessaires, puis à soumettre à nouveau la déclaration.

Pour toute question ou assistance, veuillez contacter le service de l’état civil de {{ $data['hopital'] }}.

Merci de votre compréhension.

Cordialement,
{{ $data['hopital'] }}
Service de l’état civil du Mali
@endif
