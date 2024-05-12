<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //admin
        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'phone'=>'09426979396',
            'gender'=>'male',
            'address'=>'Yangon',
            'role'=>'admin',
            'password'=> Hash::make('admin123'),
        ]);

        //user
        User::create([
            'name'=>'user',
            'email'=>'user@gmail.com',
            'phone'=>'09752437332',
            'gender'=>'female',
            'address'=>'Yangon',
            'role'=>'user',
            'password'=> Hash::make('user123'),
        ]);
    }
}
