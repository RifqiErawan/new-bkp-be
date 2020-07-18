<?php

use Illuminate\Database\Seeder;
use App\KategoriMasalah;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = [
            ['name' => 'Gangguan suasana hati.'],
            ['name' => 'Gangguan psikotik.'],
            ['name' => 'Gangguan makan.'],
            ['name' => 'Gangguan kontrol impuls dan kecanduan.'],
            ['name' => 'Gangguan obsesif-kompulsif.'],
            ['name' => 'Gangguan stres pasca-trauma.'],
            ['name' => 'Gangguan kepribadian.'],
        ];
        foreach($kategori as $key){
        		KategoriMasalah::create($key);
    		}
    }
}
