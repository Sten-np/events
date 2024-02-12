@extends('layouts.layoutadmin')

@section('topmenu')
    <div>
        <a href="{{ route('users.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">All Users</a>
        <a href="{{ route('users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create User</a>
    </div><br>
@endsection

@section('content')
    <div class="container">
        <h1>Users</h1>

        @if(session('status'))
            <div class="alert alert-success bg-green-500">
                {{ session('status') }}
            </div>
        @endif
        @if(session('status-wrong'))
            <div class="alert alert-danger bg-red-400">
                {{ session('status-wrong') }}
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>UserName</th>
                <th>Action</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        <a href="{{ route('users.show', ['user' => $user->id]) }}">Show</a>
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}">Edit</a>
                    </td>
                    <td>
                        {{--                            Hier komt Delete--}}
                        <a href="{{ route('users.delete', ['user' => $user->id]) }}">Delete</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="container max-w-4xl mx-auto pb-10 flex justify-between items-center px-3">
        <div class="text-xs">
            {{ $users->links() }}
        </div>
    </div>



@endsection
