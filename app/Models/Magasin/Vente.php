<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'quantity',
        'date',
        'product_id',
        'magasin_id'
    ];

    public function magasin()
    {
        return $this->belongsTo(Magasin::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
