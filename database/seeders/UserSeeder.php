<?php

namespace Database\Seeders;

use App\Models\Qiz;
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
        User::create([
            'name' => 'Admin',
            'email'=>'tuitdif@gmail.com',
            'password'=>bcrypt('206916700'),
        ]);

    }
}
