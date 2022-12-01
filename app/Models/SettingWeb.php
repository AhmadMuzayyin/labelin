<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingWeb extends Model
{
    use HasFactory;
    protected $table = 'setting_web';
    protected $fillable = ['nama_website', 'kode_website', 'logo_dark', 'logo_light', 'telpon', 'email', 'alamat', 'deskripsi', 'username_digiflazz', 'apiKey_digiflazz', 'serverKey_payment_gateway', 'is_aktif_website', 'api_key_payment_gateway', 'api_key_inquiry_game', 'url_wa_gateway', 'session_id_wa_gateway'];
}
