<?php

namespace App\Models;
use App\Models\User;
use App\Models\Quest;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderQ extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function quest(){
        return $this->belongsToMany(Quest::class)->withPivot('file_jawab', 'jawaban_pilgan');
    }
}
