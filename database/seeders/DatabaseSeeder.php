<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            UserSeeder::class,
            SettingWebSeeder::class,
            RoleSeeder::class,
            CategorySeeder::class,
            TypeQr::class
        ]);
        Partner::create([
            'code' => '2354342',
            'name' => 'Ahmad Muzayyin',
            'email' => 'demo@labelin.co',
            'phone' => '085155353793',
            'pic' => 'MS Glow',
            'password' => Hash::make('mocachino'),
            'photo' => 'defaul.jpg',
            'address' => 'Gadu Barat Ganding Sumenep'
        ]);
    }
}
