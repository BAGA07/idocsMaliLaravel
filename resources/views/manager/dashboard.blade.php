@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard Manager</h1>
            <p class="text-gray-600 mt-2">Gérez vos agents et structures</p>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Agents -->
            <div class="bg-blue-600 text-white p-6 rounded-2xl shadow-md flex items-center justify-between">
                <div>
                    <h4 class="text-sm font-semibold">Total Agents</h4>
                    <div class="text-3xl font-bold">{{ $totalAgents ?? 0 }}</div>
                </div>
                <div>
                    <i class="fa fa-users fa-3x opacity-40"></i>
                </div>
            </div>

            <!-- Agents Hôpital -->
            <div class="bg-green-600 text-white p-6 rounded-2xl shadow-md flex items-center justify-between">
                <div>
                    <h4 class="text-sm font-semibold">Agents Hôpital</h4>
                    <div class="text-3xl font-bold">{{ $agentsHopital ?? 0 }}</div>
                </div>
                <div>
                    <i class="fa fa-hospital-o fa-3x opacity-40"></i>
                </div>
            </div>

            <!-- Agents Mairie -->
            <div class="bg-purple-600 text-white p-6 rounded-2xl shadow-md flex items-center justify-between">
                <div>
                    <h4 class="text-sm font-semibold">Agents Mairie</h4>
                    <div class="text-3xl font-bold">{{ $agentsMairie ?? 0 }}</div>
                </div>
                <div>
                    <i class="fa fa-building fa-3x opacity-40"></i>
                </div>
            </div>

            <!-- Total Structures -->
            <div class="bg-orange-600 text-white p-6 rounded-2xl shadow-md flex items-center justify-between">
                <div>
                    <h4 class="text-sm font-semibold">Structures</h4>
                    <div class="text-3xl font-bold">{{ $totalStructures ?? 0 }}</div>
                </div>
                <div>
                    <i class="fa fa-map-marker fa-3x opacity-40"></i>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Gestion des Agents</h3>
                <div class="space-y-3">
                    <a href="{{ route('manager.agents.index') }}" 
                       class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 text-center">
                        <i class="fa fa-users mr-2"></i> Voir tous les agents
                    </a>
                    <a href="{{ route('manager.agents.create') }}" 
                       class="block w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 text-center">
                        <i class="fa fa-user-plus mr-2"></i> Ajouter un agent
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Gestion des Structures</h3>
                <div class="space-y-3">
                    <a href="{{ route('manager.structures.index') }}" 
                       class="block w-full bg-purple-600 hover:bg-purple-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 text-center">
                        <i class="fa fa-building mr-2"></i> Voir toutes les structures
                    </a>
                    <a href="{{ route('manager.structures.create') }}" 
                       class="block w-full bg-orange-600 hover:bg-orange-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 text-center">
                        <i class="fa fa-plus mr-2"></i> Ajouter une structure
                    </a>
                </div>
            </div>
        </div>

        <!-- Activités récentes -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Activités récentes</h3>
            <div class="space-y-3">
                @forelse($recentLogs ?? [] as $log)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $log->action }}</p>
                            <p class="text-xs text-gray-500">{{ $log->details }}</p>
                        </div>
                    </div>
                    <span class="text-xs text-gray-400">{{ $log->created_at->diffForHumans() }}</span>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Aucune activité récente</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection 