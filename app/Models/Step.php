<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $table = 'register_step';
    protected $guarded = [];

    protected $attributes = [
        'step' => "1",
    ];
}
