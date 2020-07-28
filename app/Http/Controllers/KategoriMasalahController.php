<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Jurusan;
use App\KategoriMasalah;
use App\ProgramStudi;
use App\Konseling;
use App\Konselor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use DB;


class KategoriMasalahController extends Controller
{
    // Authorization to mahasiswa & konselor
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:konselor,mahasiswa,pd3');
    }

    // Get all schedule
    public function getAll(){
        try{
            // $list_konseling = Konseling::select('id','konselor_id','waktu_mulai','waktu_selesai','status')->get();
            $list_kategori = KategoriMasalah::all();
            return $this->apiResponse(200, 'success', ['list_kategori' => $list_kategori]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }

}
