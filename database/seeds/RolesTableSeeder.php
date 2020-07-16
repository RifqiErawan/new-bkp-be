<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['display_name' => 'Administrator', 'name' => 'admin'],
            ['display_name' => 'Konselor', 'name' => 'konselor'],
            ['display_name' => 'Mahasiswa', 'name' => 'mahasiswa'],
            ['display_name' => 'Pembantu Direktur Bidang Kemahasiswaan', 'name' => 'pd3'],
        ];
        foreach($roles as $role){
        		Role::create($role);
    		}
    }
}
