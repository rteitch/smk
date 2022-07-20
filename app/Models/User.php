<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\JobClass;
use App\Models\OrderQ;
use App\Models\Skill;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'roles',
        'alamat',
        'nomor_induk',
        'phone',
        'tempat_lahir',
        'tanggal_lahir',
        'level',
        'skor',
        'exp',
        'gender',
        'avatar',
        'background',
        'created_at',
        'updated_at',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function jobclass(){
        return $this->belongsToMany(JobClass::class)->withPivot('user_id', 'job_class_id')->withTimestamps();
    }

    public function orderq(){
        return $this->hasMany(OrderQ::class);
    }

    public function artikel(){
        return $this->hasMany(Artikel::class);
    }

    public function skill(){
        return $this->belongsToMany(Skill::class)->withPivot('user_id', 'skill_id')->withTimestamps();
    }

    public function notifikasi(){
        return $this->hasMany(Notifikasi::class);
    }

    public function orderr(){
        return $this->hasMany(OrderR::class);
    }

    public function isHasJobclass($id){
        return $this->jobclass()->where('job_class_id', $id)->exists();
    }

    public function isHasSkill($id){
        return $this->skill()->where('skill_id', $id)->exists();
    }

    public function skillUser(){
        return $this->hasManyThrough(Jobclass::class, Skill::class);
    }

    // public function isHasOrderQ($id){
    //     return $this->orderq()->where('user_id', $id)->exists();
    // }

    // public function isHasOrderQuest($id){
    //     return $this->orderq()->
    // }
}
