<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class JobClass extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user(){
        return $this->belongsToMany(User::class)->withPivot('user_id', 'job_class_id')->withTimestamps();
    }

    public function skill(){
        return $this->belongsToMany(Skill::class)->withPivot('job_class_id', 'skill_id');
    }
}
