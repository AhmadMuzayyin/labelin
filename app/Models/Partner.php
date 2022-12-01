<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['code', 'name', 'email', 'phone', 'pic', 'password', 'address', 'photo'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var string[]
     */
    // protected $hidden = ['password'];

    // public function businesses()
    // {
    //     return $this->belongsToMany(Business::class, 'business_partners');
    // }
}
