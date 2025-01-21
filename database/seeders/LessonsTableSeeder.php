<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lesson;
class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lessons = [
            [
                'title' => 'Basic Home Row',
                'content' => 'asdf jkl;',
                'difficulty' => Lesson::DIFFICULTY_BEGINNER,
            ],
            [
                'title' => 'Common Words',
                'content' => 'the quick brown fox jumps over the lazy dog',
                'difficulty' => Lesson::DIFFICULTY_BEGINNER,
            ],
            [
                'title' => 'Numbers and Symbols',
                'content' => '1234567890!@#$%^&*()',
                'difficulty' => Lesson::DIFFICULTY_INTERMEDIATE,
            ],
            [
                'title' => 'Programming Syntax',
                'content' => 'function hello() { console.log("Hello, World!"); }',
                'difficulty' => Lesson::DIFFICULTY_ADVANCED,
            ],
        ];

        foreach ($lessons as $lesson) {
            Lesson::create($lesson);
        }
    }
    }

