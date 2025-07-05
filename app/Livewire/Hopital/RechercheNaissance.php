<?php

namespace App\Http\Livewire\Hopital;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\VoletDeclaration;

class RechercheNaissance extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'bootstrap'; // ou 'tailwind' selon ton template

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $declarations = VoletDeclaration::with('declarant')
            ->where(function ($query) {
                $query->where('prenom_enfant', 'like', '%' . $this->search . '%')
                    ->orWhere('nom_enfant', 'like', '%' . $this->search . '%')
                    ->orWhere('prenom_pere', 'like', '%' . $this->search . '%')
                    ->orWhere('nom_pere', 'like', '%' . $this->search . '%')
                    ->orWhereHas('declarant', function ($q) {
                        $q->where('numero_declaration', 'like', '%' . $this->search . '%');
                    });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.hopital.recherche-naissance', [
            'declarations' => $declarations,
        ]);
    }
}
