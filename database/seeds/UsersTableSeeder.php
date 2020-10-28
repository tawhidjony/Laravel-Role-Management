<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'super-admin',
            'email' => 'admin@gmail.com',
            'photo' => 'assets/img/user.png',
            'password' => bcrypt('123456'),
        ]);
        DB::table('roles')->insert([
            'name' => 'super-admin',
            'guard_name' => 'web'
        ]);
        $user = User::where('name','super-admin')->first();
        $user->assignRole('super-admin');
    }
}
