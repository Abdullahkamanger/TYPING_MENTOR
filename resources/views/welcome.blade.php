<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Typing_MENTOR</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" alt="Laravel background" />
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <svg class="h-12 w-auto text-white lg:h-16 lg:text-></svg>
                    </div>
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @auth
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Dashboard
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </header>

                <main class="mt-6">
                    <!-- Hero Section -->
                    <section class="text-center">
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-8">Welcome to Typing Mentor</h1>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-8">Learn typing for free with our comprehensive and interactive lessons. Improve your typing speed and accuracy at your own pace!</p>
                        <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 rounded mr-2">Get Started</a>
                        <a href="{{ route('typing') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded">Start Practicing</a>
                    </section>

                    <!-- Features Section -->
                    <section class="mt-12 grid gap-6 lg:grid-cols-3 lg:gap-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg p-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Interactive Lessons</h2>
                            <p class="text-gray-700 dark:text-gray-300">Engage in interactive typing lessons designed to enhance your skills.</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg p-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Track Your Progress</h2>
                            <p class="text-gray-700 dark:text-gray-300">Monitor your typing speed and accuracy to see your improvement over time.</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg p-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Join the Community</h2>
                            <p class="text-gray-700 dark:text-gray-300">Join our community of typists and participate in leaderboards and challenges.</p>
                        </div>
                    </section>
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                   &copy; TYPING_MENTOR | ALL RIGHTS RESERVED.
                </footer>
            </div>
        </div>
    </div>
</body>
</html>
