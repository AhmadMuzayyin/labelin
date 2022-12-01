<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'code' => fake()->numberBetween(5),
                'name' => 'Bahan Makanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => fake()->numberBetween(5),
                'name' => 'Elektronik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => fake()->numberBetween(5),
                'name' => 'Dokumen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => fake()->numberBetween(5),
                'name' => 'Farmasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => fake()->numberBetween(5),
                'name' => 'Kosmetik Parfum',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => fake()->numberBetween(5),
                'name' => 'Perhiasan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => fake()->numberBetween(5),
                'name' => 'Fashion',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
