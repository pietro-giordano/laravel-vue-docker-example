<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i <= 15; $i++) {
            Task::create([
                'title' => $faker->words(3, true),
                'description' => $faker->paragraph(3),
            ]);
        }
    }
}
