@extends('layouts.layoutpublic')

@section('title', 'Your orders')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-6">Your orders:</h1>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Number</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cost</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order placed</th>
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
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
