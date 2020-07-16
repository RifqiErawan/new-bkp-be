<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Mahasiswa;
use App\Konselor;
use App\PembantuDirektur;
use App\ProgramStudi;
use App\Jurusan;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function getAllUser()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->profile = $this->getUserProfile($user);
            $user->roles = $this->getUserRole($user);
        }
        return $this->apiResponse(200, 'success', ['users' => $users]);
    }

    public function getSingleUser(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
        ]);
        try {
            $user = User::where('username', $request->username)->firstOrFail();
            $user->profile = $this->getUserProfile($user);
            $user->roles = $this->getUserRole($user);
            return $this->apiResponse(200, 'success', ['user' => $user]);
        } catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }

    // Create Mahasiswa Account
    public function createMahasiswa(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required|string|max:10|unique:mahasiswa,nim|unique:users,username',
            'nama' => 'required|string',
            'email' => 'required|email|unique:mahasiswa,email',
            'program_studi_id' => 'required|integer',
            'semester' => 'required|integer|gt:0|lt:8',
            'angkatan' => 'required|integer|gt:0',
        ]);
        try {
            $user = new User;
            $programStudi = ProgramStudi::findOrFail($request->program_studi_id);
            $mahasiswaRole = Role::where('name', 'mahasiswa')->firstOrFail();
            $user->username = $request->nim;
            $user->password = app('hash')->make($request->nim);
            $user->save();
            $user->roles()->attach($mahasiswaRole->id);
            $mahasiswa = new Mahasiswa;
            $mahasiswa->user_id = $user->id;
            $mahasiswa->nim = $request->nim;
            $mahasiswa->nama = $request->nama;
            $mahasiswa->email = $request->email;
            $mahasiswa->semester = $request->semester;
            $mahasiswa->angkatan = $request->angkatan;
            $mahasiswa->program_studi_id = $programStudi->id;
            $mahasiswa->save();
            $mahasiswa_data = array(
                'mahasiswa' => $mahasiswa,
                'user' => $user
            );
            return $this->apiResponse(200, 'Mahasiswa created', ['mahasiswa_data' => $mahasiswa_data]);
        } catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }

    public function createKonselor(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|string|max:10|unique:konselor,nip|unique:users,username',
            'nama' => 'required|string',
            'email' => 'required|email|unique:konselor,email',
            'program_studi_id' => 'required|integer',
        ]);
        try {
            $program_studi_id = ProgramStudi::findOrFail($request->program_studi_id);
            $konselorRole = Role::where('name', 'konselor')->firstOrFail();
            $user = new User;
            $user->username = $request->nip;
            $user->password = app('hash')->make($request->nip);
            $user->save();
            $user->roles()->attach($konselorRole->id);
            $konselor = new Konselor;
            $konselor->user_id = $user->id;
            $konselor->nip = $request->nip;
            $konselor->nama = $request->nama;
            $konselor->email = $request->email;
            $konselor->program_studi_id = $program_studi_id->id;
            $konselor->save();
            $konselorData = array(
                'konselor' => $konselor,
                'user' => $user
            );
            return $this->apiResponse(200, 'Konselor created', ['konselor_data' => $konselorData]);
        } catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }

    public function createPembantuDirektur(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string',
        ]);
        try {
            $pd3Role = Role::where('name', 'pd3')->firstOrFail();
            $user = new User;
            $user->username = $request->nama;
            $user->password = app('hash')->make($request->nama);
            $user->save();
            $user->roles()->attach($pd3Role->id);
            $pd3 = new PembantuDirektur;
            $pd3->user_id = $user->id;
            $pd3->nama = $request->nama;
            $pd3->save();
            $pd3Data = array(
                'pd3' => $pd3,
                'user' => $user
            );
            return $this->apiResponse(200, 'Pembantu Direktur created', ['pd3_data' => $pd3Data]);
        } catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }
}
