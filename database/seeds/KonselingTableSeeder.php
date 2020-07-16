<?php

use Illuminate\Database\Seeder;
use App\Konseling;

class KonselingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $konselingList = [
          ['mhs_id' => 1,
          'konselor_id' => 1,
          'waktu_mulai' => '2019-10-28 08:30:00',
          'waktu_selesai' => '2019-10-28 09:30:00',
          'deskripsi' => 'Membutuhkan motivasi',
          'tempat' => 'Ruang BKP'],

          ['mhs_id' => 1,
          'konselor_id' => 2,
          'waktu_mulai' => '2019-12-28 08:30:00',
          'waktu_selesai' => '2019-12-28 09:30:00',
          'deskripsi' => 'Membutuhkan motivasi lagi',
          'tempat' => 'Ruang BKP'],

          ['mhs_id' => 2,
          'konselor_id' => 1,
          'waktu_mulai' => '2019-12-28 09:45:00',
          'waktu_selesai' => '2019-12-28 10:30:00',
          'deskripsi' => 'Membutuhkan motivasi serius',
          'tempat' => 'Ruang BKP']
        ];

        foreach($konselingList as $konseling){
        		Konseling::create($konseling);
    		}
    }
}
