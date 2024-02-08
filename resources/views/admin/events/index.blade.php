@extends('layouts.layoutadmin')

@section('topmenu')
    <div>
        <a href="{{ route('events.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Index Events</a>
        <a href="{{ route('events.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Event</a>
    </div><br>
@endsection

@section('content')
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if(session('status-wrong'))
        <div class="alert alert-danger">
            {{ session('status-wrong') }}
        </div>
    @endif
    <div class="container">
        <h1>Events</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Event Location</th>
                    <th>Event Description</th>
                    <th>Event Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->date }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->event_description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
