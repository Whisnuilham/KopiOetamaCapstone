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
     */
    public function run(): void
    {
        User::create([
            'name'=>'Whisnu Tauhid Ilham S',
            'email'=>'whisnu@gmail.com',
            'password'=>Hash::make('12345678'),
            'jabatan'=>1,
        ]);
    }
}
