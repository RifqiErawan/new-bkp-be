<?php

use Illuminate\Database\Seeder;
use App\PembantuDirektur;

class PembantuDirekturTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pd3 = [
            [
              'user_id' => 12,
              'nama' => 'PD III'],
        ];
        foreach ($pd3 as $pd3Item) {
            PembantuDirektur::create($pd3Item);
        }
    }
}
