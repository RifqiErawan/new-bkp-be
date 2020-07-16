<?php

use Illuminate\Database\Seeder;
use App\User;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =  User::findOrFail(1);
        $user->roles()->attach(1);

        $user =  User::findOrFail(2);
        $user->roles()->attach(2);
        $user =  User::findOrFail(3);
        $user->roles()->attach(2);
        $user =  User::findOrFail(4);
        $user->roles()->attach(2);
        $user =  User::findOrFail(5);
        $user->roles()->attach(2);
        $user =  User::findOrFail(6);
        $user->roles()->attach(2);

        $user =  User::findOrFail(7);
        $user->roles()->attach(3);
        $user =  User::findOrFail(8);
        $user->roles()->attach(3);
        $user =  User::findOrFail(9);
        $user->roles()->attach(3);
        $user =  User::findOrFail(10);
        $user->roles()->attach(3);
        $user =  User::findOrFail(11);
        $user->roles()->attach(3);

        $user =  User::findOrFail(12);
        $user->roles()->attach(4);
    }
}
