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
            'name' => 'Nodirbek',
            'email'=>'ccnodirbekcc@gmail.com',
            'password'=>bcrypt('Nodirbek7566'),
        ]);

        Qiz::firstOrCreate(
            ['fio' => 'Murodova Mushtariy',
             'sinfi' => 11,
             'yoshi' => 18,
                'rasmi' => 'qizlar/TD4iHVyMwapbfPkFdnHIMZRW2uY1kU5Zf062Ozn0.jpg']
        );

    }
}
