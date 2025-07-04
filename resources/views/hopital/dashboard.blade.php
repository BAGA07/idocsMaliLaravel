@php
use Illuminate\Pagination\Paginator;
@endphp

@extends('layouts.app')

@section('content')
<div class="right_col" role="main">
    <div class="row mt-4">
        {{-- Statistique - Total des demandes --}}
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-file-text-o"></i></div>
                <div class="count">
                    @if(isset($totalNaissances))
                    {{ $totalNaissances }}
                    @else
                    00
                    @endif
                </div>
                <h3>Total des Naissance</h3>
                <p>Depuis votre inscription</p>
            </div>
        </div>

        {{-- Statistique - Demandes validées --}}
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-mars"></i></div>
                <div class="count">
                    @if(isset($totalGarçons))
                    {{ $totalGarçons }}
                    @else
                    00
                    @endif
                </div>
                <h3>Total Garçons</h3>
                <p>Le nombre de garçon née cette année</p>
            </div>
        </div>

        {{-- Statistique - Demandes en attente --}}
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-venus"></i></div>
                <div class="count">
                    @if(isset($totalFilles))
                    {{ $totalFilles }}
                    @else
                    00
                    @endif
                </div>
                <h3>Total Filles</h3>
                <p>Le nombre de filles née cette année</p>
            </div>
        </div>
    </div>

    {{-- Tableau des demandes --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="x_panel shadow-sm" style="border-radius: 10px;">
                <div class="x_title d-flex justify-content-between align-items-center">
                    {{-- @livewire('hopital.recherche-naissance') --}}

                    <h2 class="mb-0">Liste des naissances enregistrées</h2>
                    <a href="{{ route('naissances.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Nouvelle naissance
                    </a>
                </div>

                <div class="x_content mt-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Nom du père</th>
                                    <th>Nom de la mère</th>
                                    <th>Contact Déclarant</th>
                                    <th>Sexe de l’enfant</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($declarations as $declaration)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($declaration->heure_naissance)->format('d/m/Y H:i') }}
                                    </td>
                                    <td>{{ $declaration->prenom_pere }} {{ $declaration->nom_pere }}</td>
                                    <td>{{ $declaration->prenom_mere }} {{ $declaration->nom_mere }}</td>
                                    <td>+223 {{ $declaration->declarant->telephone }}</td>
                                    <td>
                                        @if ($declaration->sexe === 'M')
                                        <span class="badge badge-primary">Masculin</span>
                                        @elseif ($declaration->sexe === 'F')
                                        <span class="badge badge-pink">Féminin</span>
                                        @else
                                        <span class="badge badge-secondary">Non défini</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <!-- Voir -->
                                        <a href="{{ route('naissances.show', $declaration->id_volet) }}"
                                            class="btn btn-sm btn-outline-info" title="Voir les détails">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <!-- Modifier -->
                                        <a href="{{ route('naissances.edit', $declaration->id_volet) }}"
                                            class="btn btn-sm btn-outline-warning" title="Modifier">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- Formulaire de suppression masqué -->
                                        <form id="delete-form-{{ $declaration->id_volet }}"
                                            action="{{ route('naissances.destroy', $declaration->id_volet) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <!-- Bouton qui déclenche le SweetAlert -->
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Supprimer"
                                            onclick="confirmDelete({{ $declaration->id_volet }})">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Aucune déclaration enregistrée.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $declarations->links(); }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection