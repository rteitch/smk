<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Skill;
use App\Models\OrderQ;

class Quest extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function skill(){
        return $this->belongsToMany(Skill::class);
    }

    public function orderq(){
        return $this->belongsToMany(OrderQ::class)->withPivot('file_jawab', 'jawaban_pilgan');
    }
}
