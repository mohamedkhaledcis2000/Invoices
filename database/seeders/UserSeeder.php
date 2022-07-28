<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->delete();
        User::create([
            'name'=>'mohamed',
            'email'=>'mohamed@example.com',
            'password'=>Hash::make('12345678'),
            'type'=>'admin'

        ]);
        User::create([
            'name'=>'Khaled',
            'email'=>'khaled@example.com',
            'password'=>Hash::make('12345678'),
            'type'=>'user'

        ]);
    }
}
