<?php

namespace App\Http\Controllers\open;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Event;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $subtotal = Cart::subtotal();
        $totalWithTax = Cart::total();
        return view('open.cart.index', compact('subtotal', 'totalWithTax'));
    }

    public function addToCart(Request $request)
    {
        // Fetch the product details from the request, you'll need to adjust this based on your application
        $productId = $request->input('event_id');
        $product = Event::find($productId);

        if ($product) {
            // Add the product to the cart
            Cart::add($product->id, $product->name, 1, 100);

            // Redirect back with success message
            return redirect()->route('cart.index')->with('success', 'Item was added to your cart');
        } else {
            // Redirect back with error message if product not found
            return redirect()->route('cart.index')->with('error', 'Product not found');
        }
    }

    public function removeFromCart($rowId)
    {
        // Remove the item from the cart
        Cart::remove($rowId);

        // Redirect back with success message
        return redirect()->route('cart.index')->with('success', 'Item has been removed');
    }

    public function updateCart(Request $request, $rowId)
    {
        // Update the item in the cart
        Cart::update($rowId, $request->input('quantity'));
        // Redirect back with success message
        return redirect()->route('cart.index')->with('success', 'Cart has been updated');
    }

}
