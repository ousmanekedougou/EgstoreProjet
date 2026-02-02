<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'icon',
        'magasin_id',
        'visible',
    ];

    public function magasin()
    {
        return $this->belongsTo(Magasin::class);
    }

    public function sub_categories(){
        return $this->hasMany(SubCategory::class);
    }
    
}
