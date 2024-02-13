<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Shop Layout</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100">
<header class="bg-white shadow-lg">
    <div class="container mx-auto px-4 py-2 flex items-center justify-between">
        <h1 class="text-lg font-bold">Events+</h1>
        <nav>
            <ul class="flex space-x-4">
                <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800">Home</a></li>
                <li><a href="{{ route('events') }}" class="text-gray-600 hover:text-gray-800">Events</a></li>

                @guest()
                    @if(Route::has('register'))
                        <a href="{{route('register')}}"
                           class="inline-block no-underline bg-black text-white text-sm py-2 px-3">Sign Up</a>
                    @endif
                    <a href="{{ route('login') }}" class="inline-block no-underline bg-black text-white text-sm py-2 px-3">Login</a>
                @else
                    <div class="w-full text-gray-700 bg-white">
                        <div x-data="{ open: false} class=flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
                            <nav :class="{ 'flex': open, 'hidden': !open}" class="flex-col flex-grow pb-4 md:pb-8 hidden md:flex md:justify-and md:flex-row">
                                <div @click.away="open = false" class="relative" x-data="{open: false}";
                                <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent dark-mode:focus:text">
                                    <div class="w-8 h-8 overflow-hidden rounded full inline-block">
                                    </div>
                                    <span class="text-center align-text-bottom w-16 h-8 overflow-hidden inline-block">{{ Auth::user()->name }}</span>
                                    <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline-block w-4 h-4 mt-1 transition-transform duration-200 transform md:-mt-1"></svg>
                                </button>
                                <div x-show="open"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     @click.away="open = false">
                                    <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                                        <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none" href="{{ route('profile.edit')  }}">My Profile</a>
                                        @hasanyrole('organizer|admin')
                                        <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none" href="{{ route('events.index') }}">Admin</a>
                                        @endhasanyrole
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                @endguest

                @auth()
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="inline-block no-underline bg-black text-white text-sm py-2 px-3">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endauth

            </ul>
        </nav>
    </div>
</header>

<div class="container mx-auto flex mt-4">

    <!-- Main Content -->
    <main class="w-3/4 p-4">
        <h2 class="text-lg font-bold mb-4">Featured Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Product Card -->
            @yield('content')
            <!-- Repeat for other products... -->
        </div>
    </main>
</div>
</body>
</html>
