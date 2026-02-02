<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorSystem extends Model
{
    use HasFactory;

      protected $fillable = [
        'quantity',
        'price_achat',
        'price_vente',
        'price_revenu',
        'status',
        'magasin_id',
        'unite_id',
        'product_id'
    ];

    public function getPriceVente(){
        return number_format($this->price_vente,2, ',','.'). ' CFA';
    }

    public function getPriceAchat(){
        return number_format($this->price_achat,2, ',','.'). ' CFA';
    }

    public function getPriceRevenu(){
        $price_revenu = $this->price_vente - $this->price_achat;
        return number_format($price_revenu,2, ',','.'). ' CFA';
    }

    public function magasin()
    {
        return $this->belongsTo(Magasin::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function unite()
    {
        return $this->belongsTo(Unite::class);
    }
}
