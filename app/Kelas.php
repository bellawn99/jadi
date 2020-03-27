<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'id', 'jadwal_id', 'nama', 'semester',
    ];

    protected $casts = ['id' => 'string'];

    public $timestamps = false;

    public function jadwal(){
        return $this->hasMany(Jadwal::class);
    }

    public function matkul(){
        return $this->hasMany(Matkul::class);
    }

    public function dosen(){
        return $this->hasMany(Dosen::class);
    }
}
