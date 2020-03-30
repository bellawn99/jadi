<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey='id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'user_id', 'nik','npwp','jk','tempat','tgl_lahir','alamat','prodi','status','krs','semester','thn_lulus','nama_bank','no_rekening','nama_rekening'
    ];

    protected $casts = ['id' => 'string'];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
