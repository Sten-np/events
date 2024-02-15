@extends('layouts.layoutpublic')

@section('title', 'Event details')

@section('content')
    <div>
        <strong>{{ $event->name }}</strong>

        <p class="mb-6">{{ $event->description }}</p>
        <label class="mb-6">Date:</label>
        <p class="mb-6">{{ $event->date }}</p>
        <label class="mb-6">Location:</label>
        <p class="mb-6">{{ $event->location }}</p>
        <label class="mb-6">Starting time:</label>
        <p class="mb-6">{{ $event->time }}</p>
        <label class="mb-6">Price:</label>
        <p class="mb-6">&euro; {{ $event->price }}</p>

        <form class="mb-6" action="{{ route('cart.add') }}" method="post">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            <button type="submit" class="bg-blue-500 font-semibold hover:bg-blue-600 px-5 py-2 rounded-md text-white">Add to cart</button>
        </form>

        <img src="{{ asset('img/event.jpeg') }}" alt="{{ $event->name }}" class="mb-6">
    </div>
@endsection
