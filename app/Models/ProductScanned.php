<?php

namespace App\Models;

use App\Models\QrCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductScanned extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function qr_code()
    {
        return $this->belongsTo(QrCode::class);
    }
}
