<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserRolesEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            LocationsTableSeeder::class,
            ServicesTableSeeder::class,
            DealsTableSeeder::class,
            CategoriesTableSeeder::class,
            TimeSlotsTableSeeder::class,
            CartsTableSeeder::class,
            AppointmentsTableSeeder::class,
            ServiceHitsTableSeeder::class,
        ]);
    }
}
