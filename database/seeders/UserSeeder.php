<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('mantapjiwa'),
            'phone_number'=>'08756241329',
            'avatar'=>'',
            'role'=>'admin',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
    }
}
