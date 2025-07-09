<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DealsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('deals')->delete();

        \DB::table('deals')->insert([
            0 => [
                'id' => 1,
                'name' => 'Deal 1',
                'description' => 'Deal 1 description',
                'discount' => 10.0,
                'start_date' => '2023-07-16',
                'end_date' => '2023-07-20',
                'is_hidden' => 0,
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
        ]);

    }
}
