<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnostic des Justificatifs - IdocsMali</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8">🔍 Diagnostic des Justificatifs</h1>
        
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">📊 Statistiques</h2>
            <div id="stats" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-blue-100 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600" id="total-demandes">...</div>
                    <div class="text-sm text-blue-800">Total des demandes</div>
                </div>
                <div class="bg-green-100 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-green-600" id="fichiers-ok">...</div>
                    <div class="text-sm text-green-800">Fichiers trouvés</div>
                </div>
                <div class="bg-red-100 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-red-600" id="fichiers-manquants">...</div>
                    <div class="text-sm text-red-800">Fichiers manquants</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold mb-4">📋 Détail des Demandes</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Nom</th>
                            <th class="px-4 py-2 text-left">Type</th>
                            <th class="px-4 py-2 text-left">Statut</th>
                            <th class="px-4 py-2 text-left">Chemin</th>
                            <th class="px-4 py-2 text-left">État</th>
                            <th class="px-4 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody id="demandes-list">
                        <tr>
                            <td colspan="7" class="text-center py-4">Chargement...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        async function chargerDiagnostic() {
            try {
                const response = await fetch('/test-justificatifs');
                const data = await response.json();
                
                // Mettre à jour les statistiques
                const total = data.total;
                const fichiersOk = data.demandes.filter(d => d.existe).length;
                const fichiersManquants = data.demandes.filter(d => !d.existe).length;
                
                document.getElementById('total-demandes').textContent = total;
                document.getElementById('fichiers-ok').textContent = fichiersOk;
                document.getElementById('fichiers-manquants').textContent = fichiersManquants;
                
                // Mettre à jour le tableau
                const tbody = document.getElementById('demandes-list');
                tbody.innerHTML = '';
                
                data.demandes.forEach(demande => {
                    const row = document.createElement('tr');
                    row.className = demande.existe ? 'bg-green-50' : 'bg-red-50';
                    
                    row.innerHTML = `
                        <td class="px-4 py-2 border">${demande.id}</td>
                        <td class="px-4 py-2 border">${demande.nom_complet}</td>
                        <td class="px-4 py-2 border">${demande.type_document}</td>
                        <td class="px-4 py-2 border">${demande.statut}</td>
                        <td class="px-4 py-2 border text-sm">${demande.chemin}</td>
                        <td class="px-4 py-2 border">
                            ${demande.existe ? 
                                '<span class="text-green-600">✅ Trouvé</span>' : 
                                '<span class="text-red-600">❌ Manquant</span>'
                            }
                        </td>
                        <td class="px-4 py-2 border">
                            ${demande.existe ? 
                                `<a href="${demande.url}" target="_blank" class="text-blue-600 hover:underline">Voir</a>` : 
                                '<span class="text-gray-500">-</span>'
                            }
                        </td>
                    `;
                    
                    tbody.appendChild(row);
                });
                
            } catch (error) {
                console.error('Erreur lors du chargement:', error);
                document.getElementById('demandes-list').innerHTML = 
                    '<tr><td colspan="7" class="text-center py-4 text-red-600">Erreur lors du chargement des données</td></tr>';
            }
        }
        
        // Charger les données au chargement de la page
        document.addEventListener('DOMContentLoaded', chargerDiagnostic);
    </script>
</body>
</html> 