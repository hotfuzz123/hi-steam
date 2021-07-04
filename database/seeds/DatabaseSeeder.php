<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            SliderSeeder::class,
            CategorySeeder::class,
            CourseSeeder::class,
            // HomeworkSeeder::class,
            // GradeSeeder::class,
            MissionSeeder::class,
            UserSeeder::class,
        ]);
    }
}
