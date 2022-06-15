<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reward extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function orderr(){
        return $this->belongsToMany(OrderR::class);
    }
}
