<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('locations')->delete();

        \DB::table('locations')->insert([
            0 => [
                'id' => 1,
                'name' => 'Ell Salon 1',
                'address' => 'Address 1',
                'telephone_number' => '1234567890',
                'status' => 1,
                'created_at' => '2023-09-29 18:08:59',
                'updated_at' => '2023-09-29 18:08:59',
            ],
            1 => [
                'id' => 2,
                'name' => 'Ell Salon 2',
                'address' => 'Address 2',
                'telephone_number' => '1234567890',
                'status' => 1,
                'created_at' => '2023-09-29 18:08:59',
                'updated_at' => '2023-09-29 18:08:59',
            ]
        ]);

    }
}
