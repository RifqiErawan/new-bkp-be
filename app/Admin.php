<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
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
}
