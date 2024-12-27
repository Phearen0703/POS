<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'name' => 'phearen',
                'username' => 'admin',
                'email' => 'phearen@ad.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$qcrb8a6SVIYqBCbEAVyJEeu1m0Sv0BAYepzD.al7W77s8vxGW/Muu',
                'remember_token' => NULL,
                'created_at' => '2024-12-24 08:31:55',
                'updated_at' => '2024-12-24 08:31:55',
            ),
        ));
        
        
    }
}