<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\User;
use Hash;

class UsersSeeder extends Seeder
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
                'name'      =>  'admin',
                'email'     =>  'admin@gmail.com',
                'password'  =>  Hash::make('admin'),
                'remember_token'    =>  str_random(10)
            ],
        ];

        DB::table('users')  ->  insert($data);
    }
}
