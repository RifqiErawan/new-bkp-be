<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konselor extends Model
{
    protected $table = 'konselor';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function programStudi(){
    	return $this->belongsTo('App\ProgramStudi');
    }
}
