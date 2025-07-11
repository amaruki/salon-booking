<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DealsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        DB::table('deals')->delete();

        DB::table('deals')->insert([
            [
                'name' => 'Paket Hemat Potong Rambut & Creambath',
                'description' => 'Nikmati layanan potong rambut dan creambath dengan harga spesial.',
                'discount' => 15.0,
                'start_date' => '2025-07-10',
                'end_date' => '2025-07-24',
                'is_hidden' => 0,
                'service_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Diskon 20% Perawatan Wajah',
                'description' => 'Dapatkan diskon 20% untuk semua jenis perawatan wajah.',
                'discount' => 20.0,
                'start_date' => '2025-07-15',
                'end_date' => '2025-07-31',
                'is_hidden' => 0,
                'service_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Promo Spesial Kuku Cantik',
                'description' => 'Manicure dan pedicure dengan harga spesial.',
                'discount' => 25.0,
                'start_date' => '2025-07-12',
                'end_date' => '2025-07-26',
                'is_hidden' => 0,
                'service_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
