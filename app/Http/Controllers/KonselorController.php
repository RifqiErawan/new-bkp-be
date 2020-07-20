<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Konselor;
use Illuminate\Http\Request;
use DB;


class KonselorController extends Controller
{
     /**
     * Instantiate a new UserController instance that guarded by auth and role middleware.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('role:konselor',['except' => ['getAll']]);
    }

    public function getAll(){
       try{
           $listKonselor = Konselor::all();
           return $this->apiResponse(200, 'success', ['konselor' => $listKonselor]);
       }catch (\Exception $e) {
           return $this->apiResponse(201, $e->getMessage(), null);
       }
    }
}
