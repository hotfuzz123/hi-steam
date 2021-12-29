<?php

namespace Database\Seeders;

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
            UserSeeder::class,
            SliderSeeder::class,
            CategorySeeder::class,
            CourseSeeder::class,
            LessonSeeder::class,
            HomeworkSeeder::class,
            GradeSeeder::class,
            CommentSeeder::class,
            TipSeeder::class,
            DocumentSeeder::class,
            PostSeeder::class,
        ]);
    }
}
