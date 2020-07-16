<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konseling extends Model
{
    protected $table = 'konseling';
    protected $fillable = ['mhs_id','konselor_id', 'waktu_mulai', 'waktu_selesai', 'deskripsi', 'tempat', 'keterangan'];

    public function mahasiswa() {
        return $this->belongsTo('App\Mahasiswa', 'mhs_id');
    }

    public function konselor() {
        return $this->belongsTo('App\Konselor');
    }
}
