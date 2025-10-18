<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodPayment extends Model
{
    use HasFactory;

     protected $fillable = 
    [
        'name',
        'clientId',
        'clientSecret',
        'status',
        'visible',
        'magasin_id'
    ];
}
