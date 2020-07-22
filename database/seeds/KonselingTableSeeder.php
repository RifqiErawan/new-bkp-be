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
          'waktu_mulai' => '2020-07-01 08:30:00',
          'waktu_selesai' => '2020-07-01 09:30:00',
          'deskripsi' => 'Konsultasi masalah kepribadian. Saya sering merasa tidak enak hati.',
          'status' => 'succeed',
          'kategori_id' => 1,
          'laporan_teks' => 'Konsultasiberjalan dengan baik. Klien memiliki masalah dengan adaptasi di lingkungan kampus.',
          'tempat' => 'Ruang BKP'],

          ['mhs_id' => 3,
          'konselor_id' => 2,
          'waktu_mulai' => '2020-07-05 08:30:00',
          'waktu_selesai' => '2020-07-05 09:30:00',
          'deskripsi' => 'Masalah keluarga serius. Mohon saran dan masukan.',
          'tempat' => 'Ruang BKP / Kelas'],

          ['mhs_id' => 2,
          'konselor_id' => 1,
          'waktu_mulai' => '2020-08-10 09:45:00',
          'waktu_selesai' => '2020-08-10 10:30:00',
          'deskripsi' => 'Ditinggal oleh orang tua. Apa yang harus saya lakukan ?',
          'tempat' => 'Ruang BKP / Ruang Jurusan']
        ];

        foreach($konselingList as $konseling){
        		Konseling::create($konseling);
    		}
    }
}
