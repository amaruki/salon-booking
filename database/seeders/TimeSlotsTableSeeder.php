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

        \DB::table('time_slots')->insert([
            0 => [
                'id' => 1,
                'start_time' => '08:00:00',
                'end_time' => '09:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
            1 => [
                'id' => 2,
                'start_time' => '09:00:00',
                'end_time' => '10:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
            2 => [
                'id' => 3,
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
            3 => [
                'id' => 4,
                'start_time' => '11:00:00',
                'end_time' => '12:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
            4 => [
                'id' => 5,
                'start_time' => '12:00:00',
                'end_time' => '13:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
            5 => [
                'id' => 6,
                'start_time' => '13:00:00',
                'end_time' => '14:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
            6 => [
                'id' => 7,
                'start_time' => '14:00:00',
                'end_time' => '15:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
            7 => [
                'id' => 8,
                'start_time' => '15:00:00',
                'end_time' => '16:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
            8 => [
                'id' => 9,
                'start_time' => '16:00:00',
                'end_time' => '17:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
            9 => [
                'id' => 10,
                'start_time' => '17:00:00',
                'end_time' => '18:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
            10 => [
                'id' => 11,
                'start_time' => '18:00:00',
                'end_time' => '19:00:00',
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-09-29 18:09:00',
            ],
        ]);

    }
}
