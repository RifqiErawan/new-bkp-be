<?php

use Illuminate\Database\Seeder;
use App\Mahasiswa;

class MahasiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahasiswa = [
            ['nim' => '171511019',
            'nama' => 'Muhamad Wahyu Maulana Akbar',
            'program_studi_id' => 22,
            'user_id' => 7,
            'tempat_lahir' => 'Cirebon',
            'tanggal_lahir' => '1999-6-25',
            'gender' => 'L',
            'semester' => 6,
            'alamat' => 'Durajaya Kec. Greged',
            'kota' => 'Cirebon',
            'kode_pos' => '45172',
            'nomor_hp' => '087712345678',
            'email' => 'mahasiswa1@polban.ac.id',
            'angkatan' =>2017],

            ['nim' => '171511026',
            'nama' => 'Rifqi Oktabhiar Erawan',
            'program_studi_id' => 24,
            'user_id' => 8,
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1998-10-28',
            'gender' => 'L',
            'semester' => 6,
            'alamat' => 'Bandung',
            'kota' => 'Bandung',
            'kode_pos' => '40221',
            'nomor_hp' => '081567890916',
            'email' => 'mahasiswa2@polban.ac.id',
            'angkatan' =>2017],

            ['nim' => '171511027',
            'nama' => 'Mahasiswa Tiga',
            'program_studi_id' => 25,
            'user_id' => 9,
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1998-10-28',
            'gender' => 'L',
            'semester' => 2,
            'alamat' => 'Bandung',
            'kota' => 'Bandung',
            'kode_pos' => '45175',
            'nomor_hp' => '081567890916',
            'email' => 'mahasiswa3@polban.ac.id',
            'angkatan' =>2017],

            ['nim' => '171511028',
            'nama' => 'Mahasiswa Empat',
            'program_studi_id' => 26,
            'user_id' => 10,
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1998-10-28',
            'gender' => 'L',
            'semester' => 4,
            'alamat' => 'Bandung',
            'kota' => 'Bandung',
            'kode_pos' => '45175',
            'nomor_hp' => '081567890916',
            'email' => 'mahasiswa4@polban.ac.id',
            'angkatan' =>2017],

            ['nim' => '171511029',
            'nama' => 'Mahasiswa Lima',
            'program_studi_id' => 23,
            'user_id' => 11,
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1998-10-28',
            'gender' => 'L',
            'semester' => 6,
            'alamat' => 'Bandung',
            'kota' => 'Bandung',
            'kode_pos' => '45175',
            'nomor_hp' => '081567890916',
            'email' => 'mahasiswa5@polban.ac.id',
            'angkatan' =>2017],


        ];
        foreach ($mahasiswa as $mahasiswaItem) {
            Mahasiswa::create($mahasiswaItem);
        }
    }
}
