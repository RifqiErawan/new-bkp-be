<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);

        $this->call(AdminTableSeeder::class);
        $this->call(JurusanTableSeeder::class);
        $this->call(ProgramStudiTableSeeder::class);
        $this->call(MahasiswaTableSeeder::class);
        $this->call(KonselorTableSeeder::class);
        $this->call(KonselingTableSeeder::class);
        $this->call(PembantuDirekturTableSeeder::class);
    }
}
