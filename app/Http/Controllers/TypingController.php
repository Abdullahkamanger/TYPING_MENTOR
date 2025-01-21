<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\AchievementService;
class TypingController extends Controller
{
    protected $achievementService;

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $difficulty = $request->query('difficulty', Lesson::DIFFICULTY_BEGINNER);
        $lessons = Lesson::where('difficulty', $difficulty)->get();
        $difficultyLevels = Lesson::getDifficultyLevels();
        return view('typing', compact('lessons', 'user', 'difficulty', 'difficultyLevels'));
    }

    public function complete(Request $request)
    {
        $user = Auth::user();
        $lessonId = $request->input('lesson_id');
        $wpm = $request->input('wpm');
        $accuracy = $request->input('accuracy');

        $user->total_lessons_completed++;
        $user->average_wpm = (($user->average_wpm * ($user->total_lessons_completed - 1)) + $wpm) / $user->total_lessons_completed;
        $user->average_accuracy = (($user->average_accuracy * ($user->total_lessons_completed - 1)) + $accuracy) / $user->total_lessons_completed;

        if ($lessonId > $user->progress) {
            $user->progress = $lessonId;
        }

        $user->save();

        $this->achievementService->checkAndUnlockAchievements($user);

        return response()->json([
            'success' => true,
            'message' => 'Lesson completed successfully',
            'user' => $user,
        ]);
    }
}
