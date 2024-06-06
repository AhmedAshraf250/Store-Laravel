<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // > php artisan db:seed


        // \App\Models\User::factory(10)->create();
        // \App\Models\Product::factory(10)->create();

        Store::factory(5)->create();
        Category::factory(10)->create();
        Product::factory(100)->create();
        // $this->call(UsersSeeder::class);
    }
}
