<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{

    /**
     * OrderController constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index orders', ['only' => ['index']]);
        $this->middleware('permission:show orders', ['only' => ['show']]);
        $this->middleware('permission:create orders', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit orders', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete orders', ['only' => ['delete', 'destroy']]);
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }


    /**
     * @param Order $order
     * @return RedirectResponse
     */
    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();
        return to_route('admin.orders.index')->with('status', 'Order deleted!');
    }



}
