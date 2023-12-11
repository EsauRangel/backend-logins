<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test2@example.com',
        // ]);

        // \App\Models\Teacher::factory()->create([
        //     'name' => 'Test Teacher',
        //     'email' => 'testteacher@example.com',
        // ]);

        \App\Models\Student::factory()->create([
            'name' => 'Test student',
            'email' => 'teststudent@example.com',
        ]);
    }
}
