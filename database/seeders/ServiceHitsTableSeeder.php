<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceHitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_hits')->delete();
        
        \DB::table('service_hits')->insert(array (
            0 => 
            array (
                'id' => 1,
                'service_id' => 3,
                'hit_time' => '2023-09-29 18:08:59',
                'analytic_data_type' => 'view',
                'user_id' => NULL,
                'created_at' => '2023-10-01 09:35:13',
                'updated_at' => '2023-10-01 09:35:13',
            ),
            1 => 
            array (
                'id' => 2,
                'service_id' => 1,
                'hit_time' => '2023-09-29 18:08:59',
                'analytic_data_type' => 'view',
                'user_id' => NULL,
                'created_at' => '2023-10-01 09:46:10',
                'updated_at' => '2023-10-01 09:46:10',
            ),
            2 => 
            array (
                'id' => 3,
                'service_id' => 2,
                'hit_time' => '2023-09-29 18:08:59',
                'analytic_data_type' => 'view',
                'user_id' => NULL,
                'created_at' => '2023-10-01 09:48:34',
                'updated_at' => '2023-10-01 09:48:34',
            ),
            3 => 
            array (
                'id' => 4,
                'service_id' => 1,
                'hit_time' => '2023-09-29 18:08:59',
                'analytic_data_type' => 'view',
                'user_id' => NULL,
                'created_at' => '2023-10-01 09:55:43',
                'updated_at' => '2023-10-01 09:55:43',
            ),
            4 => 
            array (
                'id' => 5,
                'service_id' => 1,
                'hit_time' => '2023-09-29 18:08:59',
                'analytic_data_type' => 'view',
                'user_id' => NULL,
                'created_at' => '2023-10-01 09:56:11',
                'updated_at' => '2023-10-01 09:56:11',
            ),
            5 => 
            array (
                'id' => 6,
                'service_id' => 1,
                'hit_time' => '2023-09-29 18:08:59',
                'analytic_data_type' => 'view',
                'user_id' => NULL,
                'created_at' => '2023-10-01 09:56:26',
                'updated_at' => '2023-10-01 09:56:26',
            ),
            6 => 
            array (
                'id' => 7,
                'service_id' => 3,
                'hit_time' => '2023-09-29 18:08:59',
                'analytic_data_type' => 'view',
                'user_id' => NULL,
                'created_at' => '2023-10-01 12:51:40',
                'updated_at' => '2023-10-01 12:51:40',
            ),
            7 => 
            array (
                'id' => 8,
                'service_id' => 2,
                'hit_time' => '2023-09-29 18:08:59',
                'analytic_data_type' => 'view',
                'user_id' => NULL,
                'created_at' => '2023-10-01 12:51:40',
                'updated_at' => '2023-10-01 12:51:40',
            ),
            8 => 
            array (
                'id' => 9,
                'service_id' => 1,
                'hit_time' => '2023-09-29 18:08:59',
                'analytic_data_type' => 'view',
                'user_id' => NULL,
                'created_at' => '2023-10-01 12:52:03',
                'updated_at' => '2023-10-01 12:52:03',
            ),
            9 => 
            array (
                'id' => 10,
                'service_id' => 1,
                'hit_time' => '2023-09-29 18:08:59',
                'analytic_data_type' => 'view',
                'user_id' => NULL,
                'created_at' => '2023-10-01 12:53:38',
                'updated_at' => '2023-10-01 12:53:38',
            ),
            10 => 
            array (
                'id' => 11,
                'service_id' => 4,
                'hit_time' => '2023-09-29 18:08:59',
                'analytic_data_type' => 'view',
                'user_id' => NULL,
                'created_at' => '2023-10-01 12:53:50',
                'updated_at' => '2023-10-01 12:53:50',
            ),
            11 => 
            array (
                'id' => 12,
                'service_id' => 4,
                'hit_time' => '2023-09-29 18:08:59',
                'analytic_data_type' => 'view',
                'user_id' => NULL,
                'created_at' => '2023-10-01 12:58:20',
                'updated_at' => '2023-10-01 12:58:20',
            ),
        ));
        
        
    }
}