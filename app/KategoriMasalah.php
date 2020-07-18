<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriMasalah extends Model
{
    protected $table = 'kategori_masalah';
    protected $fillable = ['name'];
}
