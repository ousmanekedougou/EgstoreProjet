<?php

namespace App\Models\Magasin;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'order',
        'num_invoice',
        'name',
        'phone',
        'slug',
        'bon_commande',
        'amount',
        'magasin_id',
        'user_id',
        'client_id',
        'payment_intent_id ',
        'payment_created_at',
        'amount',
        'payment',
        'date',
        'validate',
        'type',
        'delivery',
        'status',
        'methode',
    ];

    public function getAmount(){
        return number_format($this->amount,2, ',','.'). ' cfa';
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

    public function bagages()
    {
        return $this->hasMany(Bagage::class);
    }
}
