<?php

namespace App\Http\Controllers\open;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('orderlines')->latest()->get();
        $orderLines = auth()->user()->orderlines()->with('event')->get();

        return view('open.order.index', compact('orders', 'orderLines'));
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }

        // Calculate the time difference
        $timeDifference = Carbon::parse($order->created_at)->diffInMinutes(Carbon::now());

        // Check if the order is older than 15 minutes
        if ($timeDifference > 15) {
            return redirect()->back()->with('error', 'You cannot cancel this order anymore, because the order was placed longer than 15 minutes ago');
        }
        $order->delete();
        return redirect()->back()->with('success', 'Order is cancelled successfully');
    }

}
