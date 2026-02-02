<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'our_history',
        'our_vision',
        'our_mission',
        'our_values',
        'our_invoice_info',
        'magasin_id'
    ];
    public function magasin()
    {
        return $this->belongsTo(Magasin::class, 'magasin_id', 'id');
    }
}
