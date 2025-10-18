<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColorSize extends Model
{
    use HasFactory;

     protected $fillable = 
    [
        'quantity',
        'product_id',
        'color_id',
        'size_id',
        'magasin_id',
        'visible'
    ];

      public function product()
    {
        return $this->belongsTo(Product::class);
    }

      public function color()
    {
        return $this->belongsTo(Color::class);
    }

      public function size()
    {
        return $this->belongsTo(Size::class);
    }

}
