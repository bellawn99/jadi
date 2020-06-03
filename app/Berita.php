<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';
    protected $primaryKey='id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'judul', 'isi', 'foto'
    ];

    protected $casts = ['id' => 'string'];

    public $timestamps = false;

    public function periode(){
        return $this->belongsTo(Periode::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
