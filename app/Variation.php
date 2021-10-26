<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    protected $guarded = [];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
