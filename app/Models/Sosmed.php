<?php

namespace App\Models;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sosmed extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function partner()
    {
        return $this->hasMany(Partner::class);
    }
}
