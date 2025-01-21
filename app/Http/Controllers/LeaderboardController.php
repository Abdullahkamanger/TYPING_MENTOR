<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class LeaderboardController extends Controller
{
    public function index()
    {
        $topUsers = User::orderBy('average_wpm', 'desc')
            ->take(10)
            ->get();

        return view('leaderboard', compact('topUsers'));
    }
}
 
