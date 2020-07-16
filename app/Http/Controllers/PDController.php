<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Mahasiswa;
use Illuminate\Http\Request;
use DB;


class PDController extends Controller
{
     /**
     * Instantiate a new UserController instance that guarded by auth and role middleware.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:pd3');
    }
}
