<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TimeSlotsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('time_slots')->delete();
        
        \DB::table('time_slots')->insert(array (
            0 => 
            array (
                'id' => 1,
                'start_time' => '09:00:00',
                'end_time' => '10:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ),
            1 => 
            array (
                'id' => 2,
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ),
            2 => 
            array (
                'id' => 3,
                'start_time' => '11:00:00',
                'end_time' => '12:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ),
            3 => 
            array (
                'id' => 4,
                'start_time' => '12:00:00',
                'end_time' => '13:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ),
            4 => 
            array (
                'id' => 5,
                'start_time' => '13:00:00',
                'end_time' => '14:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ),
            5 => 
            array (
                'id' => 6,
                'start_time' => '14:00:00',
                'end_time' => '15:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ),
            6 => 
            array (
                'id' => 7,
                'start_time' => '15:00:00',
                'end_time' => '16:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ),
            7 => 
            array (
                'id' => 8,
                'start_time' => '16:00:00',
                'end_time' => '17:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ),
            8 => 
            array (
                'id' => 9,
                'start_time' => '17:00:00',
                'end_time' => '18:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ),
        ));
        
        
    }
}