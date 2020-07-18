<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
              'user_id' => 1,
              'nama' => 'Nama Admin'],
        ];
        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}
