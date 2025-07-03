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
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Skin',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Makeup',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Hair',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Nails',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ),
        ));
        
        
    }
}