Bonjour {{ $data['nom_declarant'] }},

Votre déclaration de naissance (numéro de volet:{{ $data['num_volet'] }}) pour l’enfant {{ $data['nom_enfant'] }}, né(e) le {{ $data['date_naissance'] }}, a bien été enregistrée par {{ $data['hopital'] }} et transmise à la mairie compétente ce {{ $data['date_envoi'] }}.

Vous recevrez une notification dès que votre dossier sera traitée.

Merci pour votre confiance.

Cordialement,
{{ $data['hopital'] }}
Service de l’état civil du Mali
