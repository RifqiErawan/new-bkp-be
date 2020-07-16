<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';

    public function jurusan() {
        return $this->belongsTo('App\Jurusan');
    }

    public function mahasiswa(){
    	return $this->hasMany('App\Mahasiswa');
    }

    public function konselor(){
    	return $this->hasMany('App\Konselor');
    }
}
