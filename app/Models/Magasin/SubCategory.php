<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'category_id',
        'magasin_id',
        'visible',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function products(){
        return $this->hasMany(Product::class);
    }

}
