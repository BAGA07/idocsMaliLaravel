<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- Documents traités -->
    <div class="bg-blue-600 text-white p-6 rounded-2xl shadow-md flex items-center justify-between">
        <div>
            <h4 class="text-sm font-semibold">Documents traités</h4>
            <div class="text-3xl font-bold">{{ $totalDocuments }}</div>
        </div>
        <div>
            <i class="fa fa-file fa-3x opacity-40"></i>
        </div>
    </div>

    <!-- En attente -->
    <div class="bg-yellow-500 text-white p-6 rounded-2xl shadow-md flex items-center justify-between">
        <div>
            <h4 class="text-sm font-semibold">En attente</h4>
            <div class="text-3xl font-bold">{{ $documentsEnAttente }}</div>
        </div>
        <div>
            <i class="fa fa-clock fa-3x opacity-40"></i>
        </div>
    </div>

    <!-- Structures -->
    <div class="bg-cyan-600 text-white p-6 rounded-2xl shadow-md flex items-center justify-between">
        <div>
            <h4 class="text-sm font-semibold">Structures</h4>
            <div class="text-3xl font-bold">{{ $totalStructures }}</div>
        </div>
        <div>
            <i class="fa fa-hospital-o fa-3x opacity-40"></i>
        </div>
    </div>

    <!-- Utilisateurs -->
    <div class="bg-green-600 text-white p-6 rounded-2xl shadow-md flex items-center justify-between">
        <div>
            <h4 class="text-sm font-semibold">Utilisateurs</h4>
            <div class="text-3xl font-bold">{{ $totalUsers }}</div>
        </div>
        <div>
            <i class="fa fa-users fa-3x opacity-40"></i>
        </div>
    </div>

    @if($alertes['en_attente_retard'] > 0 || $alertes['managers_inactifs'] > 0)
    <div class="mb-6 space-y-4">
        @if($alertes['en_attente_retard'] > 0)
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
            <div class="flex items-center justify-between">
                <div>
                    <strong class="text-yellow-800">⚠️ Attention :</strong> 
                    <span class="font-semibold">{{ $alertes['en_attente_retard'] }} demande(s) en attente depuis plus de 7 jours !</span>
                </div>
                <span class="text-sm text-yellow-600">{{ now()->format('d/m/Y H:i') }}</span>
            </div>
            
            @if($alertes['demandes_details']->count() > 0)
            <div class="mt-3 text-sm">
                <strong class="text-yellow-800">Détails :</strong>
                <ul class="mt-1 space-y-1">
                    @foreach($alertes['demandes_details'] as $demande)
                    <li class="text-yellow-700">
                        • Volet N°{{ $demande->volet->num_volet ?? 'N/A' }} - 
                        Créé le {{ \Carbon\Carbon::parse($demande->created_at)->format('d/m/Y à H:i') }}
                        @if($demande->volet)
                            ({{ $demande->volet->prenom_enfant ?? '' }} {{ $demande->volet->nom_enfant ?? '' }})
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        @endif
        
        @if($alertes['managers_inactifs'] > 0)
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
            <div class="flex items-center justify-between">
                <div>
                    <strong class="text-red-800">🚨 Attention :</strong> 
                    <span class="font-semibold">{{ $alertes['managers_inactifs'] }} manager(s) inactif(s) depuis plus de 15 jours !</span>
                </div>
                <span class="text-sm text-red-600">{{ now()->format('d/m/Y H:i') }}</span>
            </div>
            
            @if($alertes['managers_details']->count() > 0)
            <div class="mt-3 text-sm">
                <strong class="text-red-800">Détails :</strong>
                <ul class="mt-1 space-y-1">
                    @foreach($alertes['managers_details'] as $manager)
                    <li class="text-red-700">
                        • {{ $manager->prenom }} {{ $manager->nom }} ({{ $manager->email }})
                        @if($manager->last_login_at)
                            - Dernière connexion : {{ \Carbon\Carbon::parse($manager->last_login_at)->format('d/m/Y à H:i') }}
                        @else
                            - Jamais connecté
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        @endif
    </div>
    @endif

    <div class="mt-10 bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-bold mb-4">Statut des Demandes</h3>
        <canvas id="statutChart" width="400" height="200"></canvas>
    </div>

    {{-- <div class="mt-10 bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-bold mb-4">Dernières activités</h3>
        <ul class="text-sm text-gray-700 space-y-2">
            @forelse($recentLogs as $log)
            <li>
                <span class="font-semibold text-blue-700">{{ $log->user->prenom ?? '' }} {{ $log->user->nom ?? ''
                    }}</span>
                <span class="text-gray-500">({{ $log->created_at->diffForHumans() }})</span> —
                <span class="font-semibold">{{ $log->action }}</span>
                <span class="text-gray-600">: {{ $log->details }}</span>
            </li>
            @empty
            <li>Aucune activité récente.</li>
            @endforelse
        </ul>
    </div> --}}
    {{-- // Carte des structures
    <div class="mt-10 bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-bold mb-4">📌 Carte des structures enregistrées</h3>
        <div id="map" class="w-full h-96 rounded-xl"></div>
    </div> --}}

    <div class="flex flex-wrap items-center justify-end gap-4 mb-6">
        <label for="periode" class="font-semibold text-gray-700">Période :</label>
        <select wire:model="periode" id="periode"
            class="rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            <option value="jour">Aujourd'hui</option>
            <option value="semaine">Cette semaine</option>
            <option value="mois">Ce mois</option>
            <option value="annee">Cette année</option>
        </select>
        <button wire:click="exportCsv"
            class="ml-4 px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">Exporter
            CSV</button>
        <button wire:click="exportPdf"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">Exporter
            PDF</button>
    </div>


    {{-- // Initialisation de la carte Leaflet --}}
    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script>
        const structures = @json($structuresGeo);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const map = L.map('map').setView([12.6392, -8.0029], 6); // Centre: Mali

        // OpenStreetMap base layer
        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://osm.org">OpenStreetMap</a> contributors',
            maxZoom: 18
        }).addTo(map);

        // Données structures (transmises par Livewire)
        const structures = @json($structuresGeo);

        structures.forEach(structure => {
            if (structure.latitude && structure.longitude) {
                let nom = structure.nom_hopital || structure.nom_mairie || 'Structure';
                let type = structure.nom_hopital ? 'Hôpital' : 'Mairie';
                let icon = L.divIcon({
                    className: '',
                    html: `<div style='background:${type==='Hôpital' ? '#2563EB':'#059669'};color:white;padding:4px 10px;border-radius:8px;font-size:13px;font-weight:bold;box-shadow:0 2px 8px #0001;'>${type}</div>`
                });
                L.marker([structure.latitude, structure.longitude], {icon: icon})
                    .addTo(map)
                    .bindPopup(`<strong>${nom}</strong><br>Type : ${type}`);
            }
        });
    });
    </script>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const data = @json($statsByStatus);

        const labels = Object.keys(data);
        const values = Object.values(data);

        const ctx = document.getElementById('statutChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nombre de documents',
                    data: values,
                    backgroundColor: '#2563EB',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    });
    </script>
    @endpush


</div>