<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['username' => 'admin@polban.ac.id', 'password' => app('hash')->make('admin')],

            ['username' => 'konselor1@polban.ac.id', 'password' => app('hash')->make('konselor')],
            ['username' => 'konselor2@polban.ac.id', 'password' => app('hash')->make('konselor')],
            ['username' => 'konselor3@polban.ac.id', 'password' => app('hash')->make('konselor')],
            ['username' => 'konselor4@polban.ac.id', 'password' => app('hash')->make('konselor')],
            ['username' => 'konselor5@polban.ac.id', 'password' => app('hash')->make('konselor')],

            ['username' => 'mahasiswa1@polban.ac.id', 'password' => app('hash')->make('mahasiswa')],
            ['username' => 'mahasiswa2@polban.ac.id', 'password' => app('hash')->make('mahasiswa')],
            ['username' => 'mahasiswa3@polban.ac.id', 'password' => app('hash')->make('mahasiswa')],
            ['username' => 'mahasiswa4@polban.ac.id', 'password' => app('hash')->make('mahasiswa')],
            ['username' => 'mahasiswa5@polban.ac.id', 'password' => app('hash')->make('mahasiswa')],

            ['username' => 'pd3@polban.ac.id', 'password' => app('hash')->make('pd3')],
        ];
        foreach($users as $user){
        		User::create($user);
    		}
    }
}
