<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Shop Layout</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        /* Dropdown container */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown button */
        .dropdown-btn {
            background-color: #fff;
            color: #333;
            padding: 10px 20px;
            font-size: 16px;
            border: 1px solid #ccc;
            cursor: pointer;
        }

        /* Dropdown content (hidden by default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>

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
                    <a href="{{ route('login') }}"
                       class="inline-block no-underline bg-black text-white text-sm py-2 px-3">Login</a>
                    <a href="{{ route('cart.index') }}"
                       class="inline-block no-underline bg-black text-white text-sm py-2 px-3">Cart
                        <span
                            class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                            {{ Cart::count() }}
                        </span>
                    </a>
                @else
                    <div class="dropdown">
                        <button class="dropdown-btn">{{ Auth()->user()->name }}</button>
                        <div class="dropdown-content">
                            <a href="{{ route('profile.edit') }}">Profile</a>
                            <a href="#">Orders</a>
                            @hasanyrole('admin|organizer')
                            <a href="{{ route('admin') }}">Admin</a>
                            @endhasanyrole
                        </div>
                    </div>
                    <a href="{{ route('cart.index') }}"
                       class="inline-block no-underline bg-black text-white text-sm py-2 px-3">Cart
                    </a>
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Product Card -->
            @yield('content')
            <!-- Repeat for other products... -->
        </div>
        @yield('shoppingcart')
    </main>
</div>
</body>
</html>
