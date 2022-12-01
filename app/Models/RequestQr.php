<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestQr extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['product_id', 'type_qr_id', 'qty', 'sn_length', 'amount_price', 'status', 'bukti_pembayaran', 'tgl_upload_bukti_bayar', 'tanggal_request', 'code', 'harga_satuan', 'partner_id'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['qty' => 'integer', 'sn_length' => 'integer', 'amount_price' => 'integer', 'bukti_pembayaran' => 'string', 'tanggal_request' => 'datetime:d/m/Y H:i',  'tgl_upload_bukti_bayar' => 'datetime:d/m/Y H:i', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function type_qr()
    {
        return $this->belongsTo(TypeQr::class);
    }

    public function histories()
    {
        return $this->hasMany(HistoryRequest::class, 'request_qr_id');
    }

    public function partner()
	{
		return $this->belongsTo(Partner::class);
	}
}
