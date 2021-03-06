<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@urlshortner.com',
                'username' => 'super-admin',
                'password' => Hash::make('urlshortner@123#'),
                "email_verified_at" => now()
            ], 
        ];
        DB::table('users')->insert($data);
    }
}
