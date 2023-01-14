<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class FileUploader extends Component
{
    use WithFileUploads; 

    public $files = []; 

    public function render()
    {
        return view('livewire.file-uploader');
    }
}