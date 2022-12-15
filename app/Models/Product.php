<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['code', 'name', 'slug', 'category_id', 'business_id', 'bpom', 'description', 'kemasan', 'photo', 'partner_id'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['code' => 'string', 'name' => 'string', 'slug' => 'string', 'bpom' => 'string', 'description' => 'string', 'kemasan' => 'string', 'photo' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
