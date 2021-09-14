<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;

class Abc extends Component
{
    public $letters;

    public function mount()
    {
        $this->letters = 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЫЭЮЯ';
    }

    public function render()
    {
        return view('livewire.company.abc');
    }
}
