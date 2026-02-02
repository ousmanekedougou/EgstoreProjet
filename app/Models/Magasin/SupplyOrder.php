<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order',
        'slug',
        'bon_commande',
        'magasin_id',
        'supply_id',
        'payment_intent_id ',
        'payment_created_at',
        'products',
        'amount',
        'payment',
        'date',
        'delivery',
        'status',
        'request_id',
        'type',
        'methode',
        'notify'
    ];

    public function getAmount(){
        return number_format($this->amount,2, ',','.'). ' CFA';
    }


    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }

    public function magasin()
    {
        return $this->belongsTo(Magasin::class);
    }

    public function supply_order_products()
    {
        return $this->hasMany(SupplyOrderProduct::class);
    }
}
