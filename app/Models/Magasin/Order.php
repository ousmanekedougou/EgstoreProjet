<?php

namespace App\Models\Magasin;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order',
        'num_invoice',
        'name',
        'phone',
        'slug',
        'bon_commande',
        'magasin_id',
        'user_id',
        'client_id',
        'payment_intent_id ',
        'payment_created_at',
        'products',
        'amount',
        'payment',
        'date',
        'delivery',
        'status',
        'type',
        'methode'
    ];

    

    public function getAmount(){
        return $this->amount.' CFA';
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function magasin()
    {
        return $this->belongsTo(Magasin::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
   
}
