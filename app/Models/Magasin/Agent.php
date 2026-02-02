<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Agent extends Authenticatable
{
    use HasFactory,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
        'slug',
        'image',
        'confirmation_token',
        'magasin_id',
        'code_validation',
        'expired_at'
    ];

    public function magasin()
    {
        return $this->belongsTo(Magasin::class);
    }
}
