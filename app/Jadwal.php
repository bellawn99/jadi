<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    protected $fillable = [
        'id', 'matkul_id', 'hari', 'jam_mulai', 'jam_akhir',
    ];

    protected $casts = ['id' => 'string'];

    public $timestamps = false;

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
}
