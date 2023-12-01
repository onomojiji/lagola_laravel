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
              "name" => "LAGOLA 1",
              "address" => ""
          ],
        ];

        foreach ($companies as $company){
            Company::create([
                "name" => $company["name"],
                "address" => $company["address"]
            ]);
        }

        $categories = [
          "Aucune",
          "Viennoiserie",
          "Boissons",
          "Divers",
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
