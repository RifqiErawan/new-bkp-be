<?php

use Illuminate\Database\Seeder;
use App\Konselor;

class KonselorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $konselorList = [
          ['nip' => '100000111',
          'nama' => 'Konselor Satu',
          'program_studi_id' => 22,
          'user_id' => 2,
          'tempat_lahir' => 'Bandung',
          'tanggal_lahir' => '1991-1-1',
          'gender' => 'P',
          'nomor_hp' => '081234567890',
          'email' => 'example1@gmail.com'],

          ['nip' => '100000112',
          'nama' => 'Konselor Dua',
          'program_studi_id' => 23,
          'user_id' => 3,
          'tempat_lahir' => 'Bandung',
          'tanggal_lahir' => '1991-1-1',
          'gender' => 'L',
          'nomor_hp' => '081234567890',
          'email' => 'example2@gmail.com'],

          ['nip' => '100000113',
          'nama' => 'Konselor Tiga',
          'program_studi_id' => 24,
          'user_id' => 4,
          'tempat_lahir' => 'Bandung',
          'tanggal_lahir' => '1991-1-1',
          'gender' => 'L',
          'nomor_hp' => '081234567890',
          'email' => 'example3@gmail.com'],

          ['nip' => '100000114',
          'nama' => 'Konselor Empat',
          'program_studi_id' => 25,
          'user_id' => 5,
          'tempat_lahir' => 'Bandung',
          'tanggal_lahir' => '1991-1-1',
          'gender' => 'P',
          'nomor_hp' => '081234567890',
          'email' => 'example4@gmail.com'],

          ['nip' => '100000115',
          'nama' => 'Konselor Lima',
          'program_studi_id' => 26,
          'user_id' => 6,
          'tempat_lahir' => 'Bandung',
          'tanggal_lahir' => '1991-1-1',
          'gender' => 'P',
          'nomor_hp' => '081234567890',
          'email' => 'example5@gmail.com'],
        ];
        foreach ($konselorList as $konselor) {
            Konselor::create($konselor);
        }
    }
}
