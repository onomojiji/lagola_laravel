<?php

namespace Database\Seeders;

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
        ];

        foreach ($users as $user){
            User::create([
                'name' => $user['name'],
                'phone' => $user['phone'],
                'password' => Hash::make($user['password']),
                'admin' => 1
            ]);
        }
    }
}
