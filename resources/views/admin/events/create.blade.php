@extends('layouts.layoutadmin')

@section('topmenu')
    <div>
        <a href="{{ route('events.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Index Events</a>
        <a href="{{ route('events.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Event</a>
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
    <form id="form" action="{{ route('events.store') }}" method="POST">
        @csrf
    <h1>Create Event</h1>
    <div class=" rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="event_name">
                Event Name
            </label>

            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" @error('event_name')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror value="{{ old('event_name') }}" name="event_name" id="event_name" type="text" placeholder="Event Name" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="event_description">
                Event Description
            </label>

            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" @error('event_description')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror value="{{ old('event_description') }}" name="event_description" id="event_description" type="text" placeholder="Event Description" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="event_date">
                Event Date
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" @error('event_date')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror value="{{ old('event_date') }}" name="event_date" id="event_date" type="date" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="event_location">
                Event Location
            </label>

            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" @error('event_location')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror value="{{ old('event_location') }}" name="event_location" id="event_location" type="text" placeholder="Event Location" required>
        </div>
        <div class="flex items-center justify-between">
            <button class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150
            bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700
            focus:outline-none focus:shadow-outline-purple">Create Event
            </button>
        </div>
    </div>
    </form>
@endsection
