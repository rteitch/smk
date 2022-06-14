<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class News extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function skill(){
        return $this->belongsToMany(Skill::class);
    }
}
