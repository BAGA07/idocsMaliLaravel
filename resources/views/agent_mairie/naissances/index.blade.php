<!-- Liste des actes -->
    <div class="bg-white shadow rounded mb-6">
        <div class="border-b px-6 py-3 font-semibold">Liste des actes de naissance(originale)</div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Numéro acte</th>
                        <th class="px-4 py-2 border">Nom enfant</th>
                        <th class="px-4 py-2 border">Prénom enfant</th>
                        <th class="px-4 py-2 border">Date naissance</th>
                        <th class="px-4 py-2 border">Déclarant</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actesNaissance as $acte)
                    <tr>
                        <td class="px-4 py-2 border">{{ $acte->num_acte }}</td>
                        <td class="px-4 py-2 border">{{ $acte->nom }}</td>
                        <td class="px-4 py-2 border">{{ $acte->prenom }}</td>
                        <td class="px-4 py-2 border">{{ $acte->date_naissance_enfant }}</td>
                        <td class="px-4 py-2 border">{{ $acte->declarant->prenom_declarant ?? 'N/A' }} {{
                            $acte->declarant->nom_declarant ?? '' }}</td>
                        <td class="px-4 py-2 border space-x-2">
                            <a href="{{ route('acte.show', $acte->id) }}"
                                class="relative z-10 inline-block bg-cyan-600 text-white text-xs px-3 py-1 rounded hover:bg-cyan-700">Voir</a>
                            <a href="{{ route('acte.edit', $acte->id) }}"
                                class="relative z-10 inline-block bg-yellow-500 text-white text-xs px-3 py-1 rounded hover:bg-yellow-600">Modifier</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Liste des actes -->
    <div class="bg-white shadow rounded mb-6">
        <div class="border-b px-6 py-3 font-semibold">Liste des extrait de naissances</div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Numéro acte</th>
                        <th class="px-4 py-2 border">Nom enfant</th>
                        <th class="px-4 py-2 border">Prénom enfant</th>
                        <th class="px-4 py-2 border">Date naissance</th>
                        <th class="px-4 py-2 border">Déclarant</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actesCopies as $acte)
                    <tr>
                        <td class="px-4 py-2 border">{{ $acte->num_acte }}</td>
                        <td class="px-4 py-2 border">{{ $acte->nom }}</td>
                        <td class="px-4 py-2 border">{{ $acte->prenom }}</td>
                        <td class="px-4 py-2 border">{{ $acte->date_naissance_enfant }}</td>
                        <td class="px-4 py-2 border">{{ $acte->declarant->prenom_declarant ?? 'N/A' }} {{
                            $acte->declarant->nom_declarant ?? '' }}</td>
                        <td class="px-4 py-2 border space-x-2">
                            <a href="{{ route('acte.show', $acte->id) }}"
                                class="relative z-10 inline-block bg-cyan-600 text-white text-xs px-3 py-1 rounded hover:bg-cyan-700">Voir</a>
                            <a href="{{ route('acte.edit', $acte->id) }}"
                                class="relative z-10 inline-block bg-yellow-500 text-white text-xs px-3 py-1 rounded hover:bg-yellow-600">Modifier</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>