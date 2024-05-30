<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // > php artisan db:seed --class=UserTableSeeder
        
        // \App\Models\Product::factory(10)->create();
        User::create([
            'name' => 'Ahmed Ashraf',
            'email' => 'ahmed@mail.com',
            'password' => Hash::make('12345678'),
            'phone_number' => '201060701145'
            // 'created_at' and 'updated_at' => automatically recorded with eloquent model methods
        ]);

        DB::table('users')->insert([
            'name' => 'ghaith',
            'email' => 'ghaith@mail.com',
            'password' => Hash::make('12345678'),
            'phone_number' => '201060702525',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
