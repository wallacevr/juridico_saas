<?php

namespace App\Models;

use App\CustomerGroup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Cart;
use App\Product;
class Customer extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'telephone', 'password', 'dob', 'taxvat', 'ip', 'status', 'newsletter','id_customer_group', 'accepts_terms_of_use','created_at','updated_at'
    ];

    public function addresses()
    {
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

    protected $attributes = [
        'status' => true,
    ];

    /**
     * Get the group that owns the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

}
