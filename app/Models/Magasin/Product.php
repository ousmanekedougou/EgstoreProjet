<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'unique_code',
        'magasin_id',
        'visible',
        'quantity',
        'stock',
        'ventes',
        'reference',
        'image',
        'images',
        'price',
        'price_achat',
        'price_revenu',
        'qty_alert',
        'exp_date',
        'promot',
        'promo_price',
        'desc',
        'colors',
        'sizes',
        'supply_id',
        'order_id',
        'sub_category_id'
    ];

    public function getPrice(){
        return number_format($this->price,2, ',','.'). ' CFA';
    }

    public function getPromotPrice(){
        return number_format($this->promo_price,2, ',','.'). ' CFA';
    }

    public function getProductSubtotal($productSubtotal){
        $amount = str_replace(',', '', $productSubtotal);
        return number_format($amount,2, ',','.'). ' CFA';
    }

    public function getTotalAmount($getAmount){
        $amount = str_replace(',', '', $getAmount);
        return number_format($amount,2, ',','.'). ' CFA';
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function magasin()
    {
        return $this->belongsTo(Magasin::class);
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    public function vendor_systems()
    {
        return $this->hasMany(VendorSystem::class);
    }

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }

    public function colors()
    {
        return $this->hasMany(Color::class);
    }

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }

    public function product_color_sizes()
    {
        return $this->hasMany(ProductColorSize::class);
    }
    
}
