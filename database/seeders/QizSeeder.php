<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class QizSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('uz_UZ');

        $sinflar = ['5-A','5-B','6-A','6-B','7-A','7-B','8-A','8-B','9-A','9-B','10-A','10-B','11-A','11-B'];

        $otasining_ismi = ['Sanjar', 'Farruh', 'Javlon', 'Alisher', 'Akmal', 'Sardor', 'Otabek', 'Bekzod', 'Rustam', 'Sherzod'];

        for ($i = 0; $i < 25; $i++) {

            $familya = $faker->lastName();
            $ism = $faker->firstName('female');
            $otaIsm = $faker->randomElement($otasining_ismi) . ' qizi';

            $fio = "$familya $ism $otaIsm";

            DB::table('qizlar')->insert([
                'fio' => $fio,
                'yoshi' => $faker->numberBetween(10, 18),
                'sinfi' => $faker->randomElement($sinflar),
                'telefon_raqami' => '+9989' . $faker->numberBetween(10, 99) . $faker->numberBetween(1000000, 9999999),
                'mazili' => $faker->address(),
                'rasmi' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
