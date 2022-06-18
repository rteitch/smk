<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\JobClass;
use App\Models\User;


class Skill extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function jobclass(){
        return $this->belongsToMany(JobClass::class);
    }

    public function quest(){
        return $this->belongsToMany(Quest::class);
    }

    public function artikel(){
        return $this->belongsToMany(Artikel::class);
    }

    public function user(){
        return $this->belongsToMany(User::class)->withPivot('user_id', 'skill_id');
    }

}
