<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManagersTable extends Component
{
    use WithPagination;

    public $search = '';
    public $role = '';
    public $structure = '';
    public $status = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'role' => ['except' => ''],
        'structure' => ['except' => ''],
        'status' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function updating($field)
    {
        if (in_array($field, ['search', 'role', 'structure', 'status'])) {
            $this->resetPage();
        }
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->actif = !$user->actif;
        $user->save();
    }

    public function updateRole($id, $role)
    {
        $user = User::findOrFail($id);
        $user->role = $role;
        $user->save();
    }

    public function searchManagers()
    {
        $this->resetPage();
        // Le render() sera appelé automatiquement
    }

    public function render()
    {
        $query = User::query()
            ->select(['id', 'nom', 'prenom', 'email', 'role', 'id_hopital', 'id_mairie', 'actif'])
            ->whereIn('role', ['agent_hopital', 'agent_mairie', 'admin', 'superadmin']);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('nom', 'like', '%'.$this->search.'%')
                  ->orWhere('prenom', 'like', '%'.$this->search.'%')
                  ->orWhere('email', 'like', '%'.$this->search.'%');
            });
        }
        if ($this->role) {
            $query->where('role', $this->role);
        }
        if ($this->structure) {
            if ($this->structure === 'hopital') {
                $query->whereNotNull('id_hopital');
            } elseif ($this->structure === 'mairie') {
                $query->whereNotNull('id_mairie');
            }
        }
        if ($this->status !== '') {
            $query->where('actif', $this->status === '1');
        }

        $managers = $query->orderBy('nom')->paginate($this->perPage);

        return view('livewire.admin.managers-table', [
            'managers' => $managers
        ]);
    }
}
