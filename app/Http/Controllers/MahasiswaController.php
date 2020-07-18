<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Mahasiswa;
use App\Konselor;
use App\Konseling;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use DB;


class MahasiswaController extends Controller
{
     /**
     * Instantiate a new UserController instance that guarded by auth and role middleware.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:mahasiswa');
    }

    public function update(Request $request){
        try{
            $user = Auth::User();
            $mahasiswa = $user->mahasiswa;
            $this->validate($request, [
                'nama' => 'string',
                'tempat_lahir' => 'string',
                'tanggal_lahir' => 'date|before:today',
                'gender' => 'string|max:2',
                'alamat' => 'string',
                'kota' => 'string',
                'kode_pos' => 'string',
                'nomor_hp' => 'string',
            ]);
            $mahasiswa->fill($request->only([
              'nama',
              'tempat_lahir',
              'tanggal_lahir',
              'gender',
              'alamat',
              'kota',
              'kode_pos',
              'nomor_hp'
            ]));
            $mahasiswa->save();
            return $this->apiResponse(200, 'success', ['user' => $user]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }

    public function validasiDataMahasiswa($mahasiswa){
        return (!is_null($mahasiswa->tempat_lahir) && !is_null($mahasiswa->tanggal_lahir) && !is_null($mahasiswa->gender) && !is_null($mahasiswa->semester) && !is_null($mahasiswa->alamat) && !is_null($mahasiswa->kota) && !is_null($mahasiswa->kode_pos) && !is_null($mahasiswa->nomor_hp) && !is_null($mahasiswa->email) && !is_null($mahasiswa->angkatan) && $mahasiswa->status_keaktifan == "Aktif");
    }

    public function getAllKonselor(){
       try{
           $listKonselor = Konselor::with('programStudi')->get();
           return $this->apiResponse(200, 'success', ['konselor' => $listKonselor]);
       }catch (\Exception $e) {
           return $this->apiResponse(201, $e->getMessage(), null);
       }
    }

    public function jadwalKonseling(Request $request)
    {
        $this->validate($request, [
            'user_id_mhs' => 'required|integer',
            'user_id_konselor' => 'required|integer',
        ]);

        try {
            $user = Auth::User();
            $mahasiswa = $user->mahasiswa;



            return $this->apiResponse(200, 'success', ['user' => $mahasiswa]);
        } catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }
}
