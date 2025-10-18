<?php

namespace App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ide extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'sujet',
        'msg',
        'reply',
        'reply_by',
        'type',
        'status',
        'image',
        'magasin_id'
    ];

    public function getDuration(){
        if ($this->created_at->diffInDays(now()) < 30) {
            $duration ="Il y'a ". $this->created_at->diffInDays(now())." jour(s)";
        }elseif ($this->created_at->diffInMonths(now()) < 12) {
            $duration ="Il y'a ". $this->created_at->diffInMonths(now())." moi(s)";
        }else{
            $duration ="Il y'a ". $this->created_at->diffInYearss(now())." an(s)";
        }

        return $duration;
    }
}
