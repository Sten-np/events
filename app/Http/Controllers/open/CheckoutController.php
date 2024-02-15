<?php

namespace App\Http\Controllers\open;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{

    public function placeOrder()
    {
        try {
            if (Cart::count() == 0) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty');
            }

            if (!Auth()->check()) {
                return redirect()->route('login');
            }

            $order = Order::create([
                'user_id' => Auth()->id(),
                'total_price' => Cart::total(),
                'order_date' => Carbon::now(),
            ]);

            foreach (Cart::content() as $item) {
                $order->orderLines()->create([
                    'event_id' => $item->id,
                    'quantity' => $item->qty,
                    'total_price' => $item->price,
                ]);
            }
            Cart::destroy();

            return redirect()->route('cart.index')->with('success', 'Order has been placed. Thank you for your purchase!');

        } catch (Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Something went wrong, please try again later.');
        }




    }


}
