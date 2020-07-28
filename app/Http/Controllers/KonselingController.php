<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Jurusan;
use App\ProgramStudi;
use App\Konseling;
use App\Konselor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use DB;


class KonselingController extends Controller
{
    // Authorization to mahasiswa & konselor
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:konselor,mahasiswa,pd3',['except' => ['']]);
    }

    // Get all schedule
    public function getAll(){
        try{
            // $list_konseling = Konseling::select('id','konselor_id','waktu_mulai','waktu_selesai','status')->get();
            $list_konseling = Konseling::with('konselor')->get(['mhs_id', 'waktu_mulai', 'waktu_selesai', 'konselor_id', 'status']);
            return $this->apiResponse(200, 'success', ['list_konseling' => $list_konseling]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }

    public function getOne(Request $request)
    {
        $this->validate($request, [
            'konseling_id' => 'required|integer',
        ]);
        try{
            $konseling = Konseling::with('mahasiswa','konselor')->findOrFail($request->konseling_id);
            $program_studi = ProgramStudi::findOrFail($konseling->mahasiswa->program_studi_id);
            $konseling->program_studi = $program_studi;
            return $this->apiResponse(200, 'success', ['konseling' => $konseling]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }

    public function getOneByMahasiswa(Request $request)
    {
        $user = Auth::User();
        $mahasiswa = $user->mahasiswa;
        try{
            $konseling = array();
            $konseling = Konseling::orderBy('waktu_mulai')->with('konselor')->get()->where('mhs_id',$mahasiswa->id);
            return $this->apiResponse(200, 'success', ['konseling' => $konseling]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }

    public function getOneByKonselor(Request $request)
    {
        $user = Auth::User();
        $konselor = $user->konselor;
        try{
            $konseling = array();
            $konseling = Konseling::orderByDesc('waktu_mulai')->with('mahasiswa')->get()->where('konselor_id',$konselor->id);
            return $this->apiResponse(200, 'success', ['konseling' => $konseling]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }

    public function getKonselingMendatang(){
        try{
            $list_konseling = Konseling::where('waktu_mulai', '>=', Carbon::now())->get();
            return $this->apiResponse(200, 'success', ['$list_konseling' => $list_konseling]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }

    public function store(Request $request){
        $this->validate($request, [
            'konselor_id' => 'required|integer',
            'waktu_mulai' => 'required|after:now',
            'deskripsi' => 'required|string',
            'tempat' => 'required|string',
        ]);
        try{
            $user = Auth::User();
            $mahasiswa = $user->mahasiswa;
            $konselor = Konselor::findOrFail($request->konselor_id);
            $konseling = new Konseling;
            $konseling->fill($request->all());
            $konseling->mhs_id = $mahasiswa->id;
            $konseling->konselor_id = $konselor->id;
            $konseling->status = 'created';
            $waktuMulai = new DateTime($request->waktu_mulai);
            $konseling->waktu_mulai = $waktuMulai->format('Y-m-d H:i:s');
            $waktuSelesai = $waktuMulai->add(new DateInterval('PT' . 60 . 'M'));
            $konseling->waktu_selesai = $waktuSelesai->format('Y-m-d H:i:s');
            $konseling->save();
            return $this->apiResponse(200, 'success', ['konseling' => $konseling]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }

    public function updateByKonselor(Request $request){
        // $this->validate($request, [
        //     'konseling_id' => 'required|integer',
        //     'status' => 'required|string',
        //     // 'tempat' => 'required|string',
        // ]);
        try{
            $user = Auth::User();

            $konseling = Konseling::findOrFail($request->konseling_id);

            // if($konseling->status != 'canceled' || $konseling->status != 'succeed'){
                // $konseling->fill($request->all());
                $konseling->status = $request->status;
                $konseling->kategori_id = $request->kategori_id;
                $konseling->keterangan = $request->keterangan;
                $konseling->laporan_teks = $request->laporan_teks;
                if(strcmp( $konseling->laporan_teks, $request->laporan_teks )){
                    $konseling->attempt = $konseling->attempt + 1;
                }
                // if ($request->hasFile('image')) {
                //     if(isset($konseling->laporan_gambar)) unlink(('laporan/img/'.$post->image_url));
                //     $imageUrl = $request->title.'-image-'.time().'.'.$request->image->extension();
                //     $request->file('image')->move(('laporan/img'), $imageUrl);
                //     $konseling->laporan_gambar = $imageUrl;
                // }
                $konseling->save();
            // }

            return $this->apiResponse(200, 'success', ['konseling' => $konseling]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }

    public function updateByMahasiswa(Request $request){
        $this->validate($request, [
            'waktu_mulai' => 'required|time',
            'tempat' => 'required|string',
        ]);
        try{
            $user = Auth::User();

            $konseling = Konseling::findOrFail($request->konseling_id);

            if($konseling->status != 'canceled' || $konseling->status != 'succeed'){
                $konseling->status = 'created';
                $waktuMulai = new DateTime($request->waktu_mulai);
                $konseling->waktu_mulai = $waktuMulai->format('Y-m-d H:i:s');
                $waktuSelesai = $waktuMulai->add(new DateInterval('PT' . 60 . 'M'));
                $konseling->waktu_selesai = $waktuSelesai->format('Y-m-d H:i:s');
            }

            return $this->apiResponse(200, 'success', ['konseling' => $konseling]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }
}
