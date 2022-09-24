<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DumyUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
               'name'=>'Admin',
               'email'=>'rahmanmoshiur253@gmail.com',
               'phone'=>'01934622580',
               'image'=>'https://picsum.photos/id/1/200/300',
                'is_admin'=>'1',
               'password'=> bcrypt('1234'),
            ],
            [
               'name'=>'Regular User',
               'email'=>'user@gmail.com',
               'phone'=>'01934622580',
               'image'=>'https://picsum.photos/id/0/200/300',
                'is_admin'=>'0',
               'password'=> bcrypt('1234'),
            ],
        ];
  
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
