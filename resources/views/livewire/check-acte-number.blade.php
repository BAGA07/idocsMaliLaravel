<div>
    @if($acteExists)
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-4 w-4 text-yellow-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Attention !</p>
                    <p class="text-sm">Un acte avec le numéro <strong>{{ $numActe }}</strong> existe déjà en base de données.</p>
                    @if($existingActe)
                        <p class="text-sm mt-1">
                            <strong>Type:</strong> {{ $existingActe->type ?? 'Original' }} | 
                            <strong>Nom:</strong> {{ $existingActe->prenom }} {{ $existingActe->nom }} | 
                            <strong>Date:</strong> {{ $existingActe->date_naissance_enfant }}
                        </p>
                    @endif
                    <p class="text-sm mt-2">Si vous continuez, la demande sera marquée comme traitée mais aucune nouvelle copie ne sera créée.</p>
                </div>
            </div>
        </div>
    @endif
</div>

