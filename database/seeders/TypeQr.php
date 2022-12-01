<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeQr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_qrs')->insert([
            'name' => 'Label thermal (3x1,5cm) Portrait',
            'price' => 350,
            'photo' => 'qrcode.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('type_qrs')->insert([
            'name' => 'Label thermal (3x1,5cm) Landscape',
            'price' => 350,
            'photo' => 'qrcode.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('type_qrs')->insert([
            'name' => '	Label Vinyl (3x1,5cm) Portrait',
            'price' => 900,
            'photo' => 'qrcode.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('type_qrs')->insert([
            'name' => 'Label Vinyl (3x1,5cm) Landscape',
            'price' => 900,
            'photo' => 'qrcode.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('type_qrs')->insert([
            'name' => '	Label hologram (3x1,5cm) Landscape',
            'price' => 1000,
            'photo' => 'qrcode.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('type_qrs')->insert([
            'name' => '	Label hologram (3x1,5cm) Portrait',
            'price' => 1000,
            'photo' => 'qrcode.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
