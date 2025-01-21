<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lesson;
use App\Models\Achievement;



class Dashboard_Controller extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalLessons = Lesson::count();
        $completedLessons = $user->total_lessons_completed;
        $progressPercentage = ($user->progress / $totalLessons) * 100;

        $recentAchievements = Achievement::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $statistics = [
            'totalLessons' => $totalLessons,
            'completedLessons' => $completedLessons,
            'progressPercentage' => $progressPercentage,
            'averageWpm' => $user->average_wpm,
            'averageAccuracy' => $user->average_accuracy,
        ];

        return view('dashboard', compact('user', 'statistics', 'recentAchievements'));
    }
}







class DashboardController extends Controller
{

}

