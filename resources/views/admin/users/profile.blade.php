@extends('layouts.layoutadmin')

@section('topmenu')
    <div>
        <a href="{{ route('users.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Index Users</a>
        <a href="{{ route('users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Users</a>
    </div><br>
@endsection

@section('content')
    <div class="container">
        <h1>Show User</h1>
        <div class="rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="user_name">
                    UserName
                </label>
                <span>{{ $user->name }}</span>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="user_email">
                    email
                </label>
                <span>{{ $user->email }}</span>
            </div>
        </div>
    </div>
@endsection
