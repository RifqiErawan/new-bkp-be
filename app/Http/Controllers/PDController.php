<?php

namespace App\Http\Controllers;

use App\KategoriMasalah;
use Illuminate\Support\Facades\Auth;
use App\Mahasiswa;
use App\Konseling;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

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

    public function jsonToCSV($json, $cfilename)
    {
        $data = json_decode($json, true);
        $fp = fopen($cfilename, 'w');
        $header = false;
        foreach ($data as $row)
        {
            if (empty($header))
            {
                $header = array_keys($row);
                fputcsv($fp, $header);
                $header = array_flip($header);
            }
            fputcsv($fp, array_merge($header, $row));
        }
        fclose($fp);
        return;
    }

    public function getDataTahunan(Request $request){
        Carbon::setLocale('id');

        $startDate = 0;
        $endDate = 0;

        if(!$request->has('year')){
            $startDate = Carbon::now()->copy()->startOfYear();
            $endDate = Carbon::now()->copy()->endOfYear();
        }
        else {
            $startDate = Carbon::createFromDate($request->year)->copy()->startOfYear();
            $endDate = Carbon::createFromDate($request->year)->copy()->endOfYear();
        }

        $dataKonseling = Konseling::whereBetween('waktu_mulai', [$startDate,$endDate])->get();

        $this->jsonToCSV(json_encode($dataKonseling),"test.xlsx");

        $dataPerstatus = (object)[];
        $dataPerstatus->created = $dataKonseling->where('status','created')->count();
        $dataPerstatus->created = $dataPerstatus->created + $dataKonseling->where('status','rescheduled-by-counselor')->count();
        $dataPerstatus->created = $dataPerstatus->created + $dataKonseling->where('status','rescheduled-by-student')->count();
        $dataPerstatus->approved = $dataKonseling->where('status','approved')->count();
        $dataPerstatus->succeed = $dataKonseling->where('status','succeed')->count();
        $dataPerstatus->canceled = $dataKonseling->where('status','canceled')->count();

        $jumlahKategori = KategoriMasalah::get()->count();
        $dataPerkategori = (object)[];
        $kat = array();

        for ($i = 0; $i <= $jumlahKategori; $i = $i + 1){
            array_push($kat,$dataKonseling->where('kategori_id',$i)->count());
        }

        $result = (object)[];
        $result->start_time = $startDate;
        $result->end_time = $endDate;
        $result->jumlah_keseluruhan = $dataKonseling->count();
        $result->jumlah_perstatus = $dataPerstatus;
        $result->jumlah_perkategori = $kat;
        $result->kategori = KategoriMasalah::get();

        return $this->apiResponse(200,"Success",$result);
    }

    public function getDataBulanan(Request $request){
        Carbon::setLocale('id');

        $startDate = 0;
        $endDate = 0;

        if(!$request->has('month')){
            $startDate = Carbon::now()->copy()->startOfMonth();
            $endDate = Carbon::now()->copy()->endOfMonth();
        }
        else {
            $startDate = Carbon::createFromDate($request->year,$request->month)->copy()->startOfMonth();
            $endDate = Carbon::createFromDate($request->year,$request->month)->copy()->endOfMonth();
        }

        $dataKonseling = Konseling::whereBetween('waktu_mulai', [$startDate,$endDate])->get();

        $dataPerstatus = (object)[];
        $dataPerstatus->created = $dataKonseling->where('status','created')->count();
        $dataPerstatus->approved = $dataKonseling->where('status','approved')->count();
        $dataPerstatus->succeed = $dataKonseling->where('status','succeed')->count();
        $dataPerstatus->canceled = $dataKonseling->where('status','canceled')->count();

        $jumlahKategori = KategoriMasalah::get()->count();
        $dataPerkategori = (object)[];

        for ($i = 0; $i <= $jumlahKategori; $i = $i + 1){
            $dataPerkategori->$i = $dataKonseling->where('kategori_id',$i)->count();
        }

        $result = (object)[];
        $result->start_time = $startDate;
        $result->end_time = $endDate;
        $result->jumlah_keseluruhan = $dataKonseling->count();
        $result->jumlah_perstatus = $dataPerstatus;
        $result->jumlah_perkategori = $dataPerkategori;
        $result->kategori = KategoriMasalah::get();

        return $this->apiResponse(200,"Success",$result);
    }

}
