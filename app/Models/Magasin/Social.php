<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'facebook',
        'whatsapp',
        'instagram',
        'tiktok',
        // 'twitter',
        // 'linkedin',
        // 'youtube',
        'magasin_id'
    ];
    public function magasin()
    {
        return $this->belongsTo(Magasin::class, 'magasin_id', 'id');
    }
}
