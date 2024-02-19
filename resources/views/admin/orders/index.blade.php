@extends('layouts.layoutadmin')

@section('content')
    <div class="container">
        <h1>All Orders</h1>

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
                    placed by
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Cancel
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
                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.orders.destroy', ['order' => $order->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
