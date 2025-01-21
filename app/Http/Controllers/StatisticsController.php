<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lesson;
class StatisticsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalLessons = Lesson::count();
        $completedLessons = $user->total_lessons_completed;
        $progressPercentage = ($user->progress / $totalLessons) * 100;

        $statistics = [
            'totalLessons' => $totalLessons,
            'completedLessons' => $completedLessons,
            'progressPercentage' => $progressPercentage,
            'averageWpm' => $user->average_wpm,
            'averageAccuracy' => $user->average_accuracy,
        ];

        return view('statistics', compact('statistics'));
    }
}
