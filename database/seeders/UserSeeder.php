<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Super Admin";
        $user->username = "admin";
        $user->password = Hash::make('12345'); 
        $user->is_admin = True;
        $user->id_daerah = 1;
        $user->save();
    }
}
