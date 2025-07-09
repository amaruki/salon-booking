<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CartsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('carts')->delete();

        \DB::table('carts')->insert([
            0 => [
                'id' => 1,
                'uuid' => '7dd78e80-a79a-4430-ae09-403b8091cc9f',
                'user_id' => 2,
                'is_paid' => 1,
                'is_cancelled' => 0,
                'is_abandoned' => 0,
                'total' => 1250.0,
                'created_at' => '2023-09-29 18:09:23',
                'updated_at' => '2023-09-29 18:25:03',
            ],
            1 => [
                'id' => 2,
                'uuid' => 'ce577bea-77bc-48c3-98fe-16b85e90018d',
                'user_id' => 2,
                'is_paid' => 1,
                'is_cancelled' => 0,
                'is_abandoned' => 0,
                'total' => 3500.0,
                'created_at' => '2023-09-29 18:37:06',
                'updated_at' => '2023-09-29 18:37:12',
            ],
            2 => [
                'id' => 3,
                'uuid' => '0a0f2166-cf54-4f59-bd82-839797f65b89',
                'user_id' => 2,
                'is_paid' => 1,
                'is_cancelled' => 0,
                'is_abandoned' => 0,
                'total' => 4000.0,
                'created_at' => '2023-09-30 02:50:23',
                'updated_at' => '2023-09-30 02:50:28',
            ],
            3 => [
                'id' => 4,
                'uuid' => 'd30017e2-cff6-4889-9d29-4a8cdb0aa782',
                'user_id' => 2,
                'is_paid' => 1,
                'is_cancelled' => 0,
                'is_abandoned' => 0,
                'total' => 1250.0,
                'created_at' => '2023-10-01 09:35:22',
                'updated_at' => '2023-10-01 09:46:25',
            ],
            4 => [
                'id' => 5,
                'uuid' => 'b6bd1843-2e5b-454a-9a54-0a900c444288',
                'user_id' => 2,
                'is_paid' => 1,
                'is_cancelled' => 0,
                'is_abandoned' => 0,
                'total' => 3000.0,
                'created_at' => '2023-10-01 09:48:44',
                'updated_at' => '2023-10-01 09:48:56',
            ],
            5 => [
                'id' => 6,
                'uuid' => '18a5336b-13af-4672-9fe9-a109c8dc57b6',
                'user_id' => 2,
                'is_paid' => 1,
                'is_cancelled' => 0,
                'is_abandoned' => 0,
                'total' => 3750.0,
                'created_at' => '2023-10-01 09:56:05',
                'updated_at' => '2023-10-01 09:57:48',
            ],
            6 => [
                'id' => 7,
                'uuid' => '42990329-c249-4fe7-9fee-3ac5bf113d91',
                'user_id' => 9,
                'is_paid' => 1,
                'is_cancelled' => 0,
                'is_abandoned' => 0,
                'total' => 1250.0,
                'created_at' => '2023-10-01 13:48:34',
                'updated_at' => '2023-10-01 13:48:41',
            ],
            7 => [
                'id' => 8,
                'uuid' => '8cc3f6f7-4527-4d27-a353-10415dfba302',
                'user_id' => 9,
                'is_paid' => 1,
                'is_cancelled' => 0,
                'is_abandoned' => 0,
                'total' => 4750.0,
                'created_at' => '2023-10-01 13:49:07',
                'updated_at' => '2023-10-01 13:49:54',
            ],
            8 => [
                'id' => 9,
                'uuid' => 'eb998e72-175b-4b67-80b8-a08511ca5855',
                'user_id' => 2,
                'is_paid' => 1,
                'is_cancelled' => 0,
                'is_abandoned' => 0,
                'total' => 5500.0,
                'created_at' => '2023-10-01 14:23:25',
                'updated_at' => '2023-10-01 17:01:56',
            ],
            9 => [
                'id' => 10,
                'uuid' => '2f8ef860-76e8-49ce-b83c-cbf412e778b1',
                'user_id' => 2,
                'is_paid' => 1,
                'is_cancelled' => 0,
                'is_abandoned' => 0,
                'total' => 1250.0,
                'created_at' => '2023-12-08 11:35:38',
                'updated_at' => '2023-12-08 11:35:41',
            ],
            10 => [
                'id' => 11,
                'uuid' => '97f0560a-e4a1-4bf9-af37-568ac380925d',
                'user_id' => 2,
                'is_paid' => 1,
                'is_cancelled' => 0,
                'is_abandoned' => 0,
                'total' => 1250.0,
                'created_at' => '2023-12-08 17:13:56',
                'updated_at' => '2023-12-08 17:14:39',
            ],
        ]);

    }
}
