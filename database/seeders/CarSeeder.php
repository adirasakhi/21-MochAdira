<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $advantagesList = [
            'AC Dingin', 'Audio Sistem', 'Ruang Luas', 'Konsumsi BBM Efisien', 'Kursi Nyaman', 'Bagasi Luas'
        ];

        for ($i = 0; $i < 10; $i++) {
            $model = $faker->word;
            $slug = Str::slug($model . '-' . Str::random(6), '-');
            $advantages = $faker->randomElements($advantagesList, 4);

            DB::table('cars')->insert([
                'brand' => $faker->company,
                'image' => 'mobil-' . ($i + 1) . '.jpg',
                'model' => $model,
                'rental_rate' => $faker->numberBetween(100000, 500000),
                'availability' => $faker->boolean,
                'description' => $faker->sentence,
                'advantages' => implode(', ', $advantages),
                'slug' => $slug,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
