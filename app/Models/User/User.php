<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Magasin\Commande;
use App\Models\Magasin\Magasin;
use App\Models\Magasin\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'slug',
        'image',
        'is_active',
        'confirmation_token',
        'code_validation',
        'expired_at',
        'termsService',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function magasins()
    {
        return $this->belongsToMany(Magasin::class,'magasin_users');
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function getOrderCount($id){
        return Order::where('user_id',$id)->where('magasin_id',AuthMagasinAgent())->orderBy('id','DESC')->count();
    }


}
