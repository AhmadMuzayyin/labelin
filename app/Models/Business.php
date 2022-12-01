<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    // protected $table = 'business';

    protected $fillable = ['code', 'name', 'brand', 'logo', 'manufacture','partner_id'];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }


}
