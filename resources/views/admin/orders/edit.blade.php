@extends('layouts.layoutadmin')

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

        Order

    </div>

@endsection
