<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Skill;

class Quest extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function skill(){
        return $this->belongsToMany(Skill::class);
    }
}
