<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'adress',
        'name_type',
        'status_type',
        'email_type',
        'phone_type',
        'rccm',
        'ninea',
        'slug',
        'amount',
        'credit',
        'restant',
        'payments',
        'depot',
        'account',
        'magasin_id',
    ];

    public function getAmount(){
        return number_format($this->amount,2, ',','.'). ' CFA';
    }

    public function getCredit(){
        return number_format($this->credit,2, ',','.'). ' CFA';
    }

    public function getDepot(){
        return number_format($this->depot,2, ',','.'). ' CFA';
    }

    public function getRestant(){
        return number_format($this->restant,2, ',','.'). ' CFA';
    }

    public function magasin()
    {
        return $this->belongsTo(Magasin::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getOrderCount($id){
        return Order::where('client_id',$id)->where('magasin_id',AuthMagasinAgent())->orderBy('id','DESC')->count();
    }
}
