<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('roles')->delete();

        \DB::table('roles')->insert([
            0 => [
                'id' => 1,
                'name' => 'Owner',
                'status' => 1,
                'created_at' => '2023-09-29 18:08:59',
                'updated_at' => '2023-09-29 18:08:59',
            ],
            1 => [
                'id' => 2,
                'name' => 'Cashier',
                'status' => 1,
                'created_at' => '2023-09-29 18:08:59',
                'updated_at' => '2023-09-29 18:08:59',
            ],
            2 => [
                'id' => 3,
                'name' => 'Customer',
                'status' => 1,
                'created_at' => '2023-09-29 18:08:59',
                'updated_at' => '2023-09-29 18:08:59',
            ],
        ]);

    }
}
