<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index orders', ['only' => ['index']]);
        $this->middleware('permission:show orders', ['only' => ['show']]);
        $this->middleware('permission:create orders', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit orders', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete orders', ['only' => ['delete', 'destroy']]);
    }

    public function index()
    {
        $orders = auth()->user()->orders()->with('orderlines')->latest()->get();
        $orderLines = auth()->user()->orderlines()->with('event')->get();

        return view('admin.order.index', compact('orders', 'orderLines'));
    }



}
