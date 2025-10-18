<?php

namespace App\Models\Magasin;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Magasin extends Authenticatable
{
    use HasFactory,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'shop_phone',
        'password',
        'admin_name',
        'image',
        'logo',
        'inv_at',
        'inv_status',
        'adresse',
        'is_active',
        'termsService',
        'code_validation',
        'confirmation_token',
        'registre_com',
        'ninea',
        'prefix',
        'visible'
    ];

    public function categories(){
        return $this->hasMany(Category::class);
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function about()
    {
        return $this->hasOne(About::class, 'magasin_id', 'id');
    }

    public function social()
    {
        return $this->hasOne(Social::class, 'magasin_id', 'id');
    }

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'magasin_users');
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    public function unites()
    {
        return $this->hasMany(Unite::class);
    }

    public function supplies()
    {
        return $this->hasMany(Supply::class);
    }

    public function supply_orders()
    {
        return $this->hasMany(SupplyOrder::class);
    }

   
}
