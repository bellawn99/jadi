<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    protected $fillable = [
        'id', 'nidn', 'nama', 'no_hp', 'alamat',
    ];

    protected $casts = ['id' => 'string'];

    public $timestamps = false;

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
}
