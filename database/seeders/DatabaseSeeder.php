<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Book;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Book::factory(10);
        User::factory()->create([
            'name' => 'Gabriel',
            'email' => 'gabrielmark210@gmail.com',
            'password' => Hash::make('123123123'),
        ]);
    }
}
