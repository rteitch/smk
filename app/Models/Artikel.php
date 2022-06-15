<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artikel extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function skill(){
        return $this->belongsToMany(Skill::class);
    }

}