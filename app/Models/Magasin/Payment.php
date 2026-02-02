<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'amount',
        'client_id',
        'magasin_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getAmount()
    {
        return number_format($this->amount,2, ',','.'). ' CFA';
    }
    
}
