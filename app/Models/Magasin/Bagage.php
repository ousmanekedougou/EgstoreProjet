<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'quantity',
        'amount',
        'reference',
        'type',
        'date',
        'commande_id',
        'magasin_id',
        'image',
        'images',
        'color',
        'size',
        'unite',
        'unique_code',
        'exp_date',
    ];

    public function getPrice(){
        return number_format($this->price,2, ',','.'). ' CFA';
    }

    public function getTotalPrice(){
        return number_format($this->price * $this->quantity,2, ',','.'). ' CFA';
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
