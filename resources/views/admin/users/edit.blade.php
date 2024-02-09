@extends('layouts.layoutadmin')

@section('topmenu')
    <div>
        <a href="{{ route('users.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Index Users</a>
        <a href="{{ route('users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Users</a>
    </div><br>
@endsection

@section('content')
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Er is iets fout gegaan!</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li><span class="block sm:inline">{{ $error }}</span></li>
                @endforeach
            </ul>
        </div><br>
    @endif
    <form id="form" action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
        @method('PUT')
        @csrf
        <h1>Edit User</h1>
        <div class=" rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="event_name">
                    User Name
                </label>

                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" @error('user_name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror value="{{ old('name', $user->name) }}" name="name" id="user_name" type="text" placeholder="Username" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="event_description">
                    User email
                </label>

                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" @error('user_email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror value="{{ old('email', $user->email) }}" name="email" id="user_email" type="text" placeholder="User Email" required>
            </div>
            <div class="flex items-center justify-between">
                <button class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150
            bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700
            focus:outline-none focus:shadow-outline-purple">Edit User
                </button>
            </div>
        </div>
    </form>
@endsection
