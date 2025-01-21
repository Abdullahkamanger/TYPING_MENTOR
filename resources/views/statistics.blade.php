@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h1 class="text-3xl font-bold mb-4">Detailed Statistics</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-gray-100 p-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-2">Progress</h2>
            <p>Completed Lessons: {{ $statistics['completedLessons'] }} / {{ $statistics['totalLessons'] }}</p>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mt-2">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $statistics['progressPercentage'] }}%"></div>
            </div>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-2">Typing Speed</h2>
            <p>Average WPM: {{ number_format($statistics['averageWpm'], 2) }}</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-2">Accuracy</h2>
            <p>Average Accuracy: {{ number_format($statistics['averageAccuracy'], 2) }}%</p>
        </div>
    </div>
</div>
@endsection

