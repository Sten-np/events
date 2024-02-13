@extends('layouts.layoutpublic')

@section('content')
    @foreach($events as $event)
        <div class="bg-white shadow-md p-4">
            <h3 class="text-lg font-semibold mb-2">{{ $event->name }}</h3>
            <p class="text-gray-700">{{ $event->description }}</p>
            <button class="mt-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Details</button>

            <form action="{{ route('cart.add') }}" method="post">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <button class="mt-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Add to cart</button>
            </form>
        </div>

    @endforeach


    <div class="container max-w-4xl mx-auto pb-10 flex justify-between items-center px-3 bottom-0 fixed">
        <div class="text-xs">
            {{ $events->links() }}
        </div>
    </div>
@endsection
