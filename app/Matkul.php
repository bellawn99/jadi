<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkul';

    protected $fillable = [
        'id', 'dosen_id', 'kode_vmk', 'nama_matkul', 'sks',
    ];

    public $timestamps = false;

    protected $casts = ['id' => 'string'];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
}
