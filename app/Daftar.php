<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daftar extends Model
{
    protected $table = 'daftar';
    protected $primaryKey='id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'user_id','praktikum_id','status'
    ];

    public $timestamps = false;

    protected $casts = ['id' => 'string'];

    public function praktikum(){
        return $this->hasMany(Praktikum::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }
}
