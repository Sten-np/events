@extends('layouts.layoutadmin')

@section('content')
    <div class="container">
        <h1>Events</h1>
{{--        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Create Event</a>--}}
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
                        <td>{{ $event->event_description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
