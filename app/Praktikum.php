<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Praktikum extends Model
{
    protected $table = 'praktikum';
    protected $primaryKey='id';
    public $incrementing = true;

    protected $fillable = [
        'id', 'ruangan_id','dosen_id','matkul_id','jadwal_id', 'semester_id'
    ];

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

    public function ruangan(){
        return $this->hasMany(Ruangan::class);
    }

    public function kelas(){
        return $this->hasMany(Kelas::class);
    }

    public function semester(){
        return $this->hasMany(Semester::class);
    }
}
