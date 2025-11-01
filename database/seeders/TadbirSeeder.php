<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TadbirSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tadbirs')->insert([
            [
                'nomi' => 'Yil Ayoli Maktab Tadbir',
                'sanasi' => '2025-11-15',
                'tavsifi' => 'Maktabdagi eng faol va iqtidorli ayol o‘quvchini e’tirof etish tadbiri.',
                'rasmi' => 'yil-ayoli.jpg',
                'yonalishi' => 'Ta’lim va rivojlanish',
                'tashkilotchi' => 'Maktab Ma’muriyati',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomi' => 'Fan Olimpiadasi',
                'sanasi' => '2025-12-01',
                'tavsifi' => 'Fan olimpiadasida g‘oliblarni taqdirlash.',
                'rasmi' => 'fan-olimpiada.jpg',
                'yonalishi' => 'Fan va texnologiya',
                'tashkilotchi' => 'Fan bo‘limi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomi' => 'Ijodiy Ko‘rgazma',
                'sanasi' => '2025-11-30',
                'tavsifi' => 'O‘quvchilarning san’at va ijodiy ishlarini namoyish etish.',
                'rasmi' => 'ijodiy-korgazma.jpg',
                'yonalishi' => 'San’at va madaniyat',
                'tashkilotchi' => 'San’at bo‘limi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
