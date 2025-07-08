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
        
        \DB::table('services')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Nail Extensions',
                'slug' => 'nail-extensions',
                'description' => 'Get beautiful nail extensions for a stylish look.',
                'image' => 'images/c5lDRhabatsByGERzbvkIlb2dqJEZdgdAywwZVvs.png',
                'price' => 1250,
                'notes' => 'Choose from a variety of nail designs and colors.',
                'allergens' => NULL,
                'benefits' => 'Adds length and beauty to your nails.',
                'aftercare_tips' => 'Avoid harsh chemicals on your nails to maintain the extensions.',
                'cautions' => NULL,
                'category_id' => 2,
                'is_hidden' => 0,
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-10-01 13:14:45',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Hair Coloring - Highlights',
                'slug' => 'hair-coloring-highlights',
                'description' => 'Add vibrant highlights to your hair for a stunning effect.',
                'image' => 'images/mTYkQwHahe1tU3Bz4jpnPTiLS1q7l7RkzT65gaBu.webp',
                'price' => 3000,
                'notes' => 'Consult with our colorist for the best shade selection.',
                'allergens' => 'Hair dye may contain allergens; inform us of any allergies.',
                'benefits' => 'Transform your look with beautifully colored highlights.',
                'aftercare_tips' => 'Use color-safe shampoos and conditioners to preserve color.',
                'cautions' => 'Patch test required for new clients with allergies.',
                'category_id' => 3,
                'is_hidden' => 0,
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-10-01 13:39:00',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Hair Treatment - Deep Conditioning',
                'slug' => 'hair-treatment-deep-conditioning',
                'description' => 'Revitalize your hair with deep conditioning treatment.',
                'image' => 'images/yltDAoFY5F1t9s46i8OYxVOu8CEwPqYq3e6BaPf1.webp',
                'price' => 4000,
                'notes' => 'Recommended for dry and damaged hair.',
                'allergens' => NULL,
                'benefits' => 'Nourish and repair your hair for improved texture and shine.',
                'aftercare_tips' => 'Use recommended hair masks for ongoing maintenance.',
                'cautions' => NULL,
                'category_id' => 3,
                'is_hidden' => 0,
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-10-01 13:39:46',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Hair Treatment - Scalp Massage',
                'slug' => 'hair-treatment-scalp-massage',
                'description' => 'Relaxing scalp massage to rejuvenate your hair and mind.',
                'image' => 'images/YY0Lh8QdH3im4bw41ruAx72mv8FsIFufYwR1hy1D.jpg',
                'price' => 3500,
                'notes' => 'Enjoy a soothing massage with aromatic oils.',
                'allergens' => 'Massage oils may contain allergens; inform us of any allergies.',
                'benefits' => 'Promote scalp health and reduce stress with this pampering treatment.',
                'aftercare_tips' => 'Take time to relax and destress after the treatment.',
                'cautions' => NULL,
                'category_id' => 3,
                'is_hidden' => 0,
                'created_at' => '2023-09-29 18:09:00',
                'updated_at' => '2023-10-01 13:39:22',
            ),
            4 => 
            array (
                'id' => 7,
                'name' => 'Service 1',
                'slug' => 'service-1-3',
                'description' => 'Service 1 description',
                'image' => NULL,
                'price' => 100,
                
                'category_id' => 1,
                'is_hidden' => 0,
                'created_at' => '2023-10-01 16:26:29',
                'updated_at' => '2023-10-01 16:26:29',
            ),
        ));
        
        
    }
}