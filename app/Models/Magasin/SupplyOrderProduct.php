<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyOrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'magasin_id',
        'visible',
        'status',
        'quantity',
        'reference',
        'image',
        'images',
        'price',
        'desc',
        'colors',
        'sizes',
        'amount',
        'supply_order_id',
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

    public function getTotalAmount(){
        return number_format($this->amount,2, ',','.'). ' CFA';
    }

    public function supply_order()
    {
        return $this->belongsTo(SupplyOrder::class);
    }
}
