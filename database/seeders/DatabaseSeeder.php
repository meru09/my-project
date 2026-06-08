<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\BeautyGlowSeeder;
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
        // Create admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@beautyglow.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);

        // Create regular test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $this->call(BeautyGlowSeeder::class);
    }
}
