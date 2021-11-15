<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\CustomerGroup;

class Customer extends  Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','dob','taxvat'
    ];

    public function addresses(){
        return $this->hasMany(Address::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
    ];

   
   /**
    * Get the group that owns the Customer
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function group(): BelongsTo
   {
       return $this->belongsTo(CustomerGroup::class, 'group_id');
   }
}
