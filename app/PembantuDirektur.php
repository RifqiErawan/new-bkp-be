<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembantuDirektur extends Model
{
    protected $table = 'pembantu_direktur';
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
