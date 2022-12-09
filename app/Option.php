<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = [];


    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }

    public function images(){
        return $this->hasMany(ProductOptionsImage::class);
    }


}
