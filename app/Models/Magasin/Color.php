<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'name',
        'visible',
        'product_id',
        'magasin_id',
    ];

     public function product()
    {
        return $this->belongsTo(Product::class);
    }

      public function product_color_sizes()
    {
        return $this->hasMany(ProductColorSize::class);
    }
}
