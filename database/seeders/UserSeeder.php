<?php

namespace Database\Seeders;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
          [
              'name' => 'ONOMO JEAN BAPTISTE',
              'phone' => '699563010',
              'password' => 'lagolapass',
          ],
            [
                "name" => "MBEYA LINE",
                "phone" => '696872444',
                "password" => 'AdminMbeyaLine'
            ],
        ];

        for ($i = 0; $i<count($users); $i++){

            ($i==0)?$isAdmin = 1:$isAdmin = 0;

            User::create([
                'name' => $users[$i]['name'],
                'phone' => $users[$i]['phone'],
                'password' => Hash::make($users[$i]['password']),
                'admin' => $isAdmin
            ]);
        }
    }
}
