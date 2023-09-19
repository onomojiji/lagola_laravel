<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $companies = [
          [
              "name" => "Nlongkak",
              "address" => "à coté de Niki Nlongkak"
          ],
          [
              "name" => "Nkolbisson",
              "address" => "En face de Total Nkolbisson"
          ]
        ];

        foreach ($companies as $company){
            Company::create([
                "name" => $company["name"],
                "address" => $company["address"]
            ]);
        }

        $categories = [
          "Aucune",
          "Salades",
          "Pains",
          "Biscuits",
          "Chocolats",
          "Crèmes",
          "Tacos",
          "Burgers"
        ];

        foreach ($categories as $category){
            Category::create([
                "name" => $category
            ]);
        }

        $this->call([
            UserSeeder::class
        ]);
    }
}
