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

    <div class="mt-10 bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-bold mb-4">Statut des Demandes</h3>
        <canvas id="statutChart" width="400" height="200"></canvas>
    </div>

    <div class="mt-10 bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-bold mb-4">Dernières activités</h3>
        <ul class="text-sm text-gray-700 space-y-2">
            <li> {{ now()->subMinutes(2)->diffForHumans() }} — Nouvel utilisateur inscrit</li>
            <li> {{ now()->subMinutes(15)->diffForHumans() }} — 3 documents en attente</li>
            <li> {{ now()->subHours(1)->diffForHumans() }} — Hôpital Gabriel Touré ajouté</li>
        </ul>
    </div>
    {{-- // Carte des structures
    <div class="mt-10 bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-bold mb-4">📌 Carte des structures enregistrées</h3>
        <div id="map" class="w-full h-96 rounded-xl"></div>
    </div> --}}



    {{-- // Initialisation de la carte Leaflet --}}
    @push('scripts')
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
                L.marker([structure.latitude, structure.longitude])
                    .addTo(map)
                    .bindPopup(`<strong>${structure.nom}</strong>`);
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