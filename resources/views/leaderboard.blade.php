@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h1 class="text-3xl font-bold mb-4">Leaderboard</h1>

    <table class="w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Rank</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Average WPM</th>
                <th class="px-4 py-2">Average Accuracy</th>
                <th class="px-4 py-2">Lessons Completed</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topUsers as $index => $user)
            <tr>
                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                <td class="border px-4 py-2">{{ $user->name }}</td>
                <td class="border px-4 py-2">{{ number_format($user->average_wpm, 2) }}</td>
                <td class="border px-4 py-2">{{ number_format($user->average_accuracy, 2) }}%</td>
                <td class="border px-4 py-2">{{ $user->total_lessons_completed }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

