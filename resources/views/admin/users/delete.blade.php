@extends('layouts.layoutadmin')

@section('topmenu')
    <div>
        <a href="{{ route('users.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Index User</a>
        <a href="{{ route('users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create User</a>
    </div><br>
@endsection

@section('content')
    <div class="card mt-6">
        <!--header-->
        <div class="card-header flex flex-row justify-between">
        </div>
        <!--end header-->


        <!-- error-->
        @if($errors->any())
            <div>
                <div class="bg-red-200 text-red-900 rounded-lg shadow-md p-6 pr-10 mb-8"
                     style="min-width: 240px">
                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <!--body-->
        <div class="card-body grid grid-cols-1 gap-6 lg:grid-cols-1">
            <div class="p-4">
                <form id="form" class="shadow-md rounded-lg px-8 pb-8 mb-4"
                      action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                    @method('DELETE')

                    @csrf
                    <label class="block text-sm">
                        <span class="text-gray-700">Name</span>
                        <input class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400
                       focus:outline none focus:shadow-outline purple form-input"
                               name="name" value="{{ old('name', $user->name) }}" type="text" disabled/>
                    </label>

                    @csrf
                    <label class="block text-sm">
                        <span class="text-gray-700">Email</span>
                        <input class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400
                       focus:outline none focus:shadow-outline purple form-input"
                               name="name" value="{{ old('email', $user->email) }}" type="text" disabled/>
                    </label>

                    <button class="mt-2 px-4 py-2 text-sm fort-medium leading-5 text-white transition-colors duration-150
                   bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700
                   focus:outline-none focus:shadow-outline-purple">Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
