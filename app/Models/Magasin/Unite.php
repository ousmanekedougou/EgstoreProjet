<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unite extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'visible',
        'code',
        'magasin_id'
    ];

      public function magasin()
    {
        return $this->belongsTo(Magasin::class);
    }

      public function vendor_systems()
    {
        return $this->hasMany(VendorSystem::class);
    }
}
