<?php

namespace App\Http\Controllers\open;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('orderlines')->latest()->get();
        $orderLines = auth()->user()->orderlines()->with('event')->get();

        return view('open.order.index', compact('orders', 'orderLines'));
    }

}
