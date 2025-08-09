<?php

namespace App\Livewire;

use App\Models\Acte;
use Livewire\Component;

class CheckActeNumber extends Component
{
    public $numActe = '';
    public $acteExists = false;
    public $existingActe = null;

    public function updatedNumActe()
    {
        if (!empty($this->numActe)) {
            $this->existingActe = Acte::where('num_acte', $this->numActe)->first();
            $this->acteExists = $this->existingActe !== null;
        } else {
            $this->acteExists = false;
            $this->existingActe = null;
        }
    }

    public function render()
    {
        return view('livewire.check-acte-number');
    }
}

