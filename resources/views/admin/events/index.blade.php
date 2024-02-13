@extends('layouts.layoutadmin')

@section('topmenu')
    <div>
        <a href="{{ route('events.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">All Events</a>
        <a href="{{ route('events.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Event</a>
    </div><br>
@endsection

@section('content')
    <div class="container">
        <h1>Events</h1>

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
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Event Location</th>
                    <th>Event Description</th>
                    <th>Actions</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->date }}</td>
                        <td>{{ $event->time }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->description }}</td>
                        <td>
                            <a href="{{ route('events.show', ['event' => $event->id]) }}">Show</a>
                            <a href="{{ route('events.edit', ['event' => $event->id]) }}">Edit</a>
                        </td>
                        <td>
                            <a href="{{ route('events.delete', ['event' => $event->id]) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="container max-w-4xl mx-auto pb-10 flex justify-between items-center px-3">
        <div class="text-xs">
            {{ $events->links() }}
        </div>
    </div>



@endsection
