@extends('layouts.layoutadmin')

@section('topmenu')
    <div>
        <a href="{{ route('events.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Index Events</a>
        <a href="{{ route('events.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Event</a>
    </div><br>
@endsection

@section('content')
    <div class="container">
        <h1>Show Event</h1>
        <div class="rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="event_name">
                    Event Name
                </label>
                <span>{{ $event->name }}</span>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="event_description">
                    Event Description
                </label>
                <span>{{ $event->description }}</span>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="event_date">
                    Event Date
                </label>
                <span>{{ $event->date }}</span>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="event_location">
                    Event Location
                </label>
                <span>{{ $event->location }}</span>
            </div>
        </div>
    </div>
@endsection
