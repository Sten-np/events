@extends('layouts.layoutpublic')

@section('title', 'Your orders')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-6">Your orders:</h1>

                @if($orders->isEmpty())
                    <p>You have no orders yet.</p>
                @endif

                @if(session('success'))
                    <div class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md mb-6">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md mb-6">
                        {{ session('error') }}
                    </div>
                @endif


                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order
                            Number
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Product
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Quantity
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cost
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order
                            placed
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Cancel order (if possible)
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order)
                        @foreach($order->orderLines as $orderLine)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $orderLine->event->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $orderLine->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->total_price }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <form action="{{ route('orders.destroy', ['order' => $order->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">
                                            Cancel
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>

                <div class="bg-red-500 mt-6 text-white px-4 py-2 rounded-md shadow-md">
                    <p>Note: orders may not be cancelled if the order is placed more than 15 minutes ago.</p>
                </div>

            </div>
        </div>
    </div>
@endsection
