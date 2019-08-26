<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name'    =>  'Denys',
            'last_name'     =>  'Panchuk',
            'email'         =>  '85coba@gmail.com',
            'password'      =>  '$2y$10$Wtmr5QPOq/KHUCkDzNJADOePY6dEWYKX2pT6SPK2ybiMRx0E88HQK',
            'nickname'      =>  'uapanchude'
        ]);

        DB::table('roles')->insert(
            ['name' =>  'admin'],
            ['name' =>  'vendor'],
            ['name' =>  'bloked']    
        );

        DB::table('permissions')->insert(
            ['name' =>  'browse_admin_panel'],
            ['name' =>  'browse_cabinet'],
            ['name' =>  'receive_new_orders']
        );

        DB::table('permission_role')->insert(
            ['role_id'  => 1, 'permission_id' => 1],
            ['role_id'  => 1, 'permission_id' => 2],
            ['role_id'  => 1, 'permission_id' => 3]
        );

        DB::table('user_role')->insert(
            ['user_id' => 1, 'role_id' => 1]
        );
    }
}
