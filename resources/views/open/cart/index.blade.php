@extends('layouts.layoutpublic')

@section('shoppingcart')
    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md">
            {{ session('error') }}
        </div>
    @endif
    <body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="flex shadow-md my-10">
            <div class="w-3/4 bg-white px-10 py-10">
                @foreach(Cart::content() as $item)
                    <div>
                        <p>{{ $item->name }}</p>
                        <p>Price: {{ $item->price }}</p>
                        <form action="{{ route('cart.update', ['rowId' => $item->rowId]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="number" max="9" name="quantity" value="{{ $item->qty }}">
                            <button type="submit" class="font-semibold hover:text-blue-500 text-gray-500 text-xs">Change</button>
                        </form>

                        <form action="{{ route('cart.remove', ['rowId' => $item->rowId]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</button>
                        </form>
                    </div>
                    <span>---------------------------------------------------------------</span>
                @endforeach
            </div>

            <div id="summary" class="w-1/4 px-8 py-10">
                <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
                <div class="flex justify-between mt-10 mb-5">
                    <span class="font-semibold text-sm uppercase">Items: {{ Cart::content()->count()  }}</span>
                    <span class="font-semibold text-sm">{{ $subtotal }}</span>
                </div>
                <div class="border-t mt-8">
                    <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                        <span>Total cost with tax</span>
                        <span>{{ $totalWithTax }}</span>
                    </div>
                    <form action="{{ route('checkout.placeOrder') }}" method="post">
                        @csrf
                        <input type="hidden" name="total" value="{{ $totalWithTax }}">
                        <button type="submit" class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Checkout</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    </body>
@endsection
