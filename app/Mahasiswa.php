<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $fillable = [
      'nama',
      'tempat_lahir',
      'tanggal_lahir',
      'gender',
      'alamat',
      'kota',
      'kode_pos',
      'nomor_hp'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function programStudi(){
    	return $this->belongsTo('App\ProgramStudi');
    }
}
