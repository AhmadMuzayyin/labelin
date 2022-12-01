<?php

namespace Database\Seeders;

use App\Models\SettingWeb;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SettingWebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingWeb::create([
            'nama_website' => 'Labelin.Co',
            'kode_website' => 'LA.c',
            'logo_dark' => 'logo.jpg',
            'logo_light' => 'logo.jpg',
            'telpon' => '081299903331',
            'email' => 'info@labelin.co',
            'alamat' => 'Surabaya',
            'deskripsi' => 'Labelin.co merupakan layanan tag API printing berteknologi dalam bentuk label yang bisa di tempel pada produk. Dengan Labelin.co para business owner dapat menjaga originalitas produk/karya mereka hingga sampai ke tangan customer dengan membedakan produk asli dan palsu di pasaran.',
            'is_aktif_website' => 'Y',
        ]);
    }
}
