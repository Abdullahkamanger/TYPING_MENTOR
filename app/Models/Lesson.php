<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'difficulty'];

    public const DIFFICULTY_BEGINNER = 'Beginner';
    public const DIFFICULTY_INTERMEDIATE = 'Intermediate';
    public const DIFFICULTY_ADVANCED = 'Advanced';

    public static function getDifficultyLevels()
    {
        return [
            self::DIFFICULTY_BEGINNER,
            self::DIFFICULTY_INTERMEDIATE,
            self::DIFFICULTY_ADVANCED,
        ];
    }
}
