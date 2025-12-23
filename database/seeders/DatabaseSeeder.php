<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin user
        User::factory()->create([
            'name' => 'Admin AHASS',
            'email' => 'admin@ahass.com',
        ]);

        // Run all seeders in order
        $this->call([
            PelangganSeeder::class,
            MotorSeeder::class,
            ItemSeeder::class,
        ]);
    }
}
