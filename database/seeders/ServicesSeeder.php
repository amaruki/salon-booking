<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'name' => 'Nail Extensions',
            'slug' => 'nail-extensions',
            'description' => 'Get beautiful nail extensions for a stylish look.',
            'image' => 'nail_extensions.jpg',
            'price' => 1250.00,
            'notes' => 'Choose from a variety of nail designs and colors.',

            //            'duration_minutes' => 90, // Duration in minutes
            'category_id' => 2, // Replace with the actual category ID
            'is_hidden' => false,
        ]);

        Service::create([
            'name' => 'Hair Coloring - Highlights',
            'slug' => 'hair-coloring-highlights',
            'description' => 'Add vibrant highlights to your hair for a stunning effect.',
            'image' => 'hair_coloring_highlights.jpg',
            'price' => 3000.00,
            //            'duration_minutes' => 120, // Duration in minutes
            'category_id' => 3, // Replace with the actual category ID
            'is_hidden' => false,
        ]);

        Service::create([
            'name' => 'Hair Treatment - Deep Conditioning',
            'slug' => 'hair-treatment-deep-conditioning',
            'description' => 'Revitalize your hair with deep conditioning treatment.',
            'image' => 'hair_treatment_deep_conditioning.jpg',
            'price' => 4000.00,

            //            'duration_minutes' => 60, // Duration in minutes
            'category_id' => 3, // Replace with the actual category ID
            'is_hidden' => false,
        ]);

        Service::create([
            'name' => 'Hair Treatment - Scalp Massage',
            'slug' => 'hair-treatment-scalp-massage',
            'description' => 'Relaxing scalp massage to rejuvenate your hair and mind.',
            'image' => 'hair_treatment_scalp_massage.jpg',
            'price' => 3500.00,

            //            'duration_minutes' => 45, // Duration in minutes
            'category_id' => 3, // Replace with the actual category ID
            'is_hidden' => false,
        ]);

    }
}
