<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('services')->delete();

        \DB::table('services')->insert([
            0 => [
                'id' => 1,
                'name' => 'Nail Extensions',
                'slug' => 'nail-extensions',
                'description' => 'Get beautiful nail extensions for a stylish look.',
                'image' => 'images/c5lDRhabatsByGERzbvkIlb2dqJEZdgdAywwZVvs.png',
                'price' => 1250,
                'category_id' => 2,
                'is_hidden' => 0,
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-10-01 13:14:45',
            ],
            1 => [
                'id' => 2,
                'name' => 'Hair Coloring - Highlights',
                'slug' => 'hair-coloring-highlights',
                'description' => 'Add vibrant highlights to your hair for a stunning effect.',
                'image' => 'images/mTYkQwHahe1tU3Bz4jpnPTiLS1q7l7RkzT65gaBu.webp',
                'price' => 3000,
                'category_id' => 3,
                'is_hidden' => 0,
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-10-01 13:39:00',
            ],
            2 => [
                'id' => 3,
                'name' => 'Hair Treatment - Deep Conditioning',
                'slug' => 'hair-treatment-deep-conditioning',
                'description' => 'Revitalize your hair with deep conditioning treatment.',
                'image' => 'images/yltDAoFY5F1t9s46i8OYxVOu8CEwPqYq3e6BaPf1.webp',
                'price' => 4000,
                'category_id' => 3,
                'is_hidden' => 0,
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-10-01 13:39:46',
            ],
            3 => [
                'id' => 4,
                'name' => 'Hair Treatment - Scalp Massage',
                'slug' => 'hair-treatment-scalp-massage',
                'description' => 'Relaxing scalp massage to rejuvenate your hair and mind.',
                'image' => 'images/YY0Lh8QdH3im4bw41ruAx72mv8FsIFufYwR1hy1D.jpg',
                'price' => 3500,
                'category_id' => 3,
                'is_hidden' => 0,
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-10-01 13:39:22',
            ],
            4 => [
                'id' => 7,
                'name' => 'Service 1',
                'slug' => 'service-1-3',
                'description' => 'Service 1 description',
                'image' => null,
                'price' => 100,
                'category_id' => 1,
                'is_hidden' => 0,
                'created_at' => '2023-10-01 16:26:29',
                'updated_at' => '2023-10-01 16:26:29',
            ],
        ]);

    }
}
