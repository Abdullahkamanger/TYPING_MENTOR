{{-- !DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
</head>
<body class="bg-gray-100 font-sans" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }">
    <nav class="bg-white dark:bg-gray-800 shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="{{ url('/') }}" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-gray-500 dark:text-gray-300 text-lg">Typing Tutor</span>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="{{ route('typing') }}" class="py-4 px-2 text-gray-500 dark:text-gray-300 font-semibold hover:text-green-500 transition duration-300">Practice</a>
                        <a href="{{ route('leaderboard') }}" class="py-4 px-2 text-gray-500 dark:text-gray-300 font-semibold hover:text-green-500 transition duration-300">Leaderboard</a>
                        <a href="{{ route('statistics') }}" class="py-4 px-2 text-gray-500 dark:text-gray-300 font-semibold hover:text-green-500 transition duration-300">Statistics</a>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-3">
                    @guest
                        <a href="{{ route('login') }}" class="py-2 px-2 font-medium text-gray-500 dark:text-gray-300 rounded hover:bg-green-500 hover:text-white transition duration-300">Log In</a>
                        <a href="{{ route('register') }}" class="py-2 px-2 font-medium text-white bg-green-500 rounded hover:bg-green-400 transition duration-300">Sign Up</a>
                    @else
                        <a href="{{ route('profile') }}" class="py-2 px-2 font-medium text-gray-500 dark:text-gray-300 rounded hover:bg-green-500 hover:text-white transition duration-300">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="py-2 px-2 font-medium text-gray-500 dark:text-gray-300 rounded hover:bg-red-500 hover:text-white transition duration-300">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8 px-4">
        @yield('content')
    </main>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
</head>
<body class="bg-gray-100 font-sans" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }">
    <nav class="bg-white dark:bg-gray-800 shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="{{ url('/') }}" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-gray-500 dark:text-gray-300 text-lg">Typing Tutor</span>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="{{ route('typing') }}" class="py-4 px-2 text-gray-500 dark:text-gray-300 font-semibold hover:text-green-500 transition duration-300">Practice</a>
                        <a href="{{ route('leaderboard') }}" class="py-4 px-2 text-gray-500 dark:text-gray-300 font-semibold hover:text-green-500 transition duration-300">Leaderboard</a>
                        <a href="{{ route('statistics') }}" class="py-4 px-2 text-gray-500 dark:text-gray-300 font-semibold hover:text-green-500 transition duration-300">Statistics</a>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-3">
                    @guest
                        <a href="{{ route('login') }}" class="py-2 px-2 font-medium text-gray-500 dark:text-gray-300 rounded hover:bg-green-500 hover:text-white transition duration-300">Log In</a>
                        <a href="{{ route('register') }}" class="py-2 px-2 font-medium text-white bg-green-500 rounded hover:bg-green-400 transition duration-300">Sign Up</a>
                    @else
                        <a href="{{ route('profile') }}" class="py-2 px-2 font-medium text-gray-500 dark:text-gray-300 rounded hover:bg-green-500 hover:text-white transition duration-300">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="py-2 px-2 font-medium text-gray-500 dark:text-gray-300 rounded hover:bg-red-500 hover:text-white transition duration-300">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8 px-4">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-12 mb-0">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Typing Mentor. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>








{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Typing Mentor') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
</head>
<body class="bg-gray-100 font-sans" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }">
    <nav class="bg-white dark:bg-gray-800 shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="{{ url('/') }}" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-gray-500 dark:text-gray-300 text-lg">Typing Mentor</span>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="{{ route('typing') }}" class="py-4 px-2 text-gray-500 dark:text-gray-300 font-semibold hover:text-green-500 transition duration-300">Practice</a>
                        <a href="{{ route('leaderboard') }}" class="py-4 px-2 text-gray-500 dark:text-gray-300 font-semibold hover:text-green-500 transition duration-300">Leaderboard</a>
                        <a href="{{ route('statistics') }}" class="py-4 px-2 text-gray-500 dark:text-gray-300 font-semibold hover:text-green-500 transition duration-300">Statistics</a>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-3">
                    @guest
                        <a href="{{ route('login') }}" class="py-2 px-2 font-medium text-gray-500 dark:text-gray-300 rounded hover:bg-green-500 hover:text-white transition duration-300">Log In</a>
                        <a href="{{ route('register') }}" class="py-2 px-2 font-medium text-white bg-green-500 rounded hover:bg-green-400 transition duration-300">Sign Up</a>
                    @else
                        <a href="{{ route('profile') }}" class="py-2 px-2 font-medium text-gray-500 dark:text-gray-300 rounded hover:bg-green-500 hover:text-white transition duration-300">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="py-2 px-2 font-medium text-gray-500 dark:text-gray-300 rounded hover:bg-red-500 hover:text-white transition duration-300">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-gray-800 text-white py-12">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to Typing Mentor</h1>
            <p class="text-lg mb-8">Learn typing for free with our comprehensive and interactive lessons.</p>
            <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 rounded mr-2">Get Started</a>
            <a href="{{ route('typing') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded">Start Practicing</a>
        </div>
    </header>

    <main class="container mx-auto mt-8 px-4">
        @yield('content')
    </main>


</body>
</html> --}}
