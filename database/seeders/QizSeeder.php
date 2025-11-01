<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Qiz;

class QizSeeder extends Seeder
{
    public function run(): void
    {
        $qizlar = [
            'Karimova Dilnoza', 'Tursunova Nodira',
            'To‘xtayeva Madina', 'Xolmatova Durdona', 'Abdullayeva Mohira',
            'Ismoilova Sevinch', 'Rasulova Maftuna', 'Saidova Zilola',
            'Yo‘ldosheva Zuxra', 'Rahimova Shaxnoza', 'Abdurahmonova Shahzoda',
            'Nazarova Aziza', 'Shukurova Malika', 'Yusupova Farangiz',
            'Sattorova Dildora', 'Shermatova Nasiba', 'Rustamova Zarnigor',
            'Sobirova Go‘zal', 'Xasanova Rayhona', 'Eshmatova Nozima',
            'Haydarova Shahrizoda', 'Toshpulatova Shahnoz', 'Mirzayeva Dilafruz',
            'Mamatova Mohigul',
        ];

        foreach ($qizlar as $fio) {
            Qiz::firstOrCreate(
                ['fio' => $fio],
                [
                    'sinfi' => fake()->numberBetween(8, 11),
                    'yoshi' => fake()->numberBetween(14, 18),
                ]
            );
        }
    }
}
