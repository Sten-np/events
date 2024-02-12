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
                    <h1 class="text-sm text-gray-800 font-semibold m-0 p-0 leading-none">{{ Auth::user()->name }}</h1>
                    <i class="fad fa fa-chevron-down ml-2 text-xs leading-none"></i>

                    <button class="hidden fixed top-0 left-0 z-10 w-full h-full menu-overflow"></button>

                    <div
                        class="text-gray-500 menu hidden md:mt-10 md:w-full rounded bg-white shadow-md absolute z-20 right-0 w-40 mt-5 py-2 amimated faster">
                        <a href="#"
                           class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:bg-gray-900 transition-all duration-300 ease-in-out">
                            <i class="fad fa-user-edit text-sm mr-1"></i>edit my profile
                        </a>
                        <a href="#"
                           class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:bg-gray-900 transition-all duration-300 ease-in-out">
                            <i class="fad fa-user-edit text-sm mr-1"></i>my inbox
                        </a>
                        <a href="#"
                           class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:bg-gray-900 transition-all duration-300 ease-in-out">
                            <i class="fad fa-user-edit text-sm mr-1"></i>chats
                        </a>
                        <hr>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white">
                            <i class="fad fa-user-times text-xs mr-1"></i>log out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="">
                            @csrf
                        </form>
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
