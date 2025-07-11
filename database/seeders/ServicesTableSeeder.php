<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        DB::table('services')->delete();

        DB::table('services')->insert([
            [
                'id' => 1,
                'name' => 'Nail Extensions',
                'slug' => 'nail-extensions',
                'description' => 'Get beautiful nail extensions for a stylish look.',
                'image' => 'images/nails.jpg',
                'price' => 125000,
                'category_id' => 2,
                'is_hidden' => 0,
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-10-01 13:14:45',
            ],
            [
                'id' => 2,
                'name' => 'Hair Coloring - Highlights',
                'slug' => 'hair-coloring-highlights',
                'description' => 'Add vibrant highlights to your hair for a stunning effect.',
                'image' => 'images/hair-coloring.jpg',
                'price' => 300000,
                'category_id' => 3,
                'is_hidden' => 0,
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-10-01 13:39:00',
            ],
            [
                'id' => 3,
                'name' => 'Hair Treatment - Deep Conditioning',
                'slug' => 'hair-treatment-deep-conditioning',
                'description' => 'Revitalize your hair with deep conditioning treatment.',
                'image' => 'images/hair-cut.jpg',
                'price' => 400000,
                'category_id' => 3,
                'is_hidden' => 0,
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-10-01 13:39:46',
            ],
            [
                'id' => 4,
                'name' => 'Hair Treatment - Scalp Massage',
                'slug' => 'hair-treatment-scalp-massage',
                'description' => 'Relaxing scalp massage to rejuvenate your hair and mind.',
                'image' => 'images/hair.jpg',
                'price' => 350000,
                'category_id' => 3,
                'is_hidden' => 0,
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-10-01 13:39:22',
            ],
            [
                'id' => 7,
                'name' => 'Service 1',
                'slug' => 'service-1-3',
                'description' => 'Service 1 description',
                'image' => 'images/makeup.jpg',
                'price' => 100000,
                'category_id' => 1,
                'is_hidden' => 0,
                'created_at' => '2023-10-01 16:26:29',
                'updated_at' => '2023-10-01 16:26:29',
            ],
        ]);

    }
}