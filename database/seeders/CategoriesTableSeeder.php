<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('categories')->delete();

        \DB::table('categories')->insert([
            0 => [
                'id' => 1,
                'name' => 'Skin',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
            1 => [
                'id' => 2,
                'name' => 'Makeup',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
            2 => [
                'id' => 3,
                'name' => 'Hair',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
            3 => [
                'id' => 4,
                'name' => 'Nails',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
        ]);

    }
}
