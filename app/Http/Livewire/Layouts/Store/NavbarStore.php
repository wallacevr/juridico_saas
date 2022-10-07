<?php

namespace App\Http\Livewire\Layouts\Store;

use Livewire\Component;

class NavbarStore extends Component
{
    public $listeners =['UpdateCart'=>'render'];
    public function render()
    {
        return view('livewire.layouts.store.navbar-store');
    }
}
