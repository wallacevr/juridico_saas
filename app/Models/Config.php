<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path', 'value',
    ];

    public static function createOrUpdate($path,$value){
        if(empty(Config::where('path', $path)->first())){
            Config::create(['path'=>$path,'value'=>$value]);
        }
        
        Config::where('path', $path)->update(['value' => $value]);
        

    }

}
