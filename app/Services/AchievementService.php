<?php

namespace App\Services;

use App\Models\User;
use App\Models\Achievement;

class AchievementService
{
    public function checkAndUnlockAchievements(User $user)
    {
        $this->checkWpmAchievements($user);
        $this->checkAccuracyAchievements($user);
        $this->checkLessonCompletionAchievements($user);
    }

    private function checkWpmAchievements(User $user)
    {
        $wpmAchievements = [
            ['wpm' => 30, 'title' => 'Speed Demon I', 'description' => 'Reached 30 WPM', 'badge_image' => 'speed_demon_1.png'],
            ['wpm' => 50, 'title' => 'Speed Demon II', 'description' => 'Reached 50 WPM', 'badge_image' => 'speed_demon_2.png'],
            ['wpm' => 70, 'title' => 'Speed Demon III', 'description' => 'Reached 70 WPM', 'badge_image' => 'speed_demon_3.png'],
        ];

        foreach ($wpmAchievements as $achievement) {
            if ($user->average_wpm >= $achievement['wpm'] && !$this->hasAchievement($user, $achievement['title'])) {
                $this->unlockAchievement($user, $achievement);
            }
        }
    }

    private function checkAccuracyAchievements(User $user)
    {
        $accuracyAchievements = [
            ['accuracy' => 90, 'title' => 'Precision Master I', 'description' => 'Reached 90% accuracy', 'badge_image' => 'precision_master_1.png'],
            ['accuracy' => 95, 'title' => 'Precision Master II', 'description' => 'Reached 95% accuracy', 'badge_image' => 'precision_master_2.png'],
            ['accuracy' => 98, 'title' => 'Precision Master III', 'description' => 'Reached 98% accuracy', 'badge_image' => 'precision_master_3.png'],
        ];

        foreach ($accuracyAchievements as $achievement) {
            if ($user->average_accuracy >= $achievement['accuracy'] && !$this->hasAchievement($user, $achievement['title'])) {
                $this->unlockAchievement($user, $achievement);
            }
        }
    }

    private function checkLessonCompletionAchievements(User $user)
    {
        $lessonAchievements = [
            ['lessons' => 10, 'title' => 'Dedicated Learner', 'description' => 'Completed 10 lessons', 'badge_image' => 'dedicated_learner.png'],
            ['lessons' => 50, 'title' => 'Typing Enthusiast', 'description' => 'Completed 50 lessons', 'badge_image' => 'typing_enthusiast.png'],
            ['lessons' => 100, 'title' => 'Keyboard Warrior', 'description' => 'Completed 100 lessons', 'badge_image' => 'keyboard_warrior.png'],
        ];

        foreach ($lessonAchievements as $achievement) {
            if ($user->total_lessons_completed >= $achievement['lessons'] && !$this->hasAchievement($user, $achievement['title'])) {
                $this->unlockAchievement($user, $achievement);
            }
        }
    }

    private function hasAchievement(User $user, string $title)
    {
        return $user->achievements()->where('title', $title)->exists();
    }

    private function unlockAchievement(User $user, array $achievementData)
    {
        $user->achievements()->create($achievementData);
    }
}
