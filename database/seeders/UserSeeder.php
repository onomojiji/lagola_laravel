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
                "name" => "Amina de mbankomo",
                "phone" => '676777879',
                "password" => 'aminadembankomo'
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

        $sellers = [
            [
                "user_id" => 2,
                "company_id" => 1,
                "cni" => "09835456",
                "sexe" => "F"
            ],
        ];

        foreach ($sellers as $seller){
            Seller::create([
                "user_id" => $seller["user_id"],
                "company_id" => $seller["company_id"],
                "cni" => $seller["cni"],
                "sexe" => $seller["sexe"],
            ]);
        }
    }
}
