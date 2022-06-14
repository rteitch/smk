<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function skill(){
        return $this->belongsToMany(Skill::class);
    }
}
