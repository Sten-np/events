<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderTest extends TestCase
{
    public function test_Cannot_Place_Order_With_Empty_Cart()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Cart::destroy();

        $response = $this->post(route('checkout.placeOrder'));

        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('error', 'Your cart is empty');
    }

    public function test_cannot_place_order_without_authentication()
    {
        Cart::destroy();

        $response = $this->post(route('checkout.placeOrder'));

        $response->assertRedirect(route('login'));
    }

    public function test_can_place_order_when_authenticated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $event = Event::factory()->create();

        Cart::add($event->id, $event->name, 1, $event->price);

        $response = $this->post(route('checkout.placeOrder'));

        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('success', 'Order has been placed. Thank you for your purchase!');
    }

    public function test_can_cancel_order_within_15_minutes()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $event = Event::factory()->create();

        Cart::add($event->id, $event->name, 1, $event->price);

        $response = $this->post(route('checkout.placeOrder'));

        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('success', 'Order has been placed. Thank you for your purchase!');

        $order = $user->orders()->first();

        $response = $this->delete(route('orders.destroy', $order->id));

        $response->assertSessionHas('success', 'Order is cancelled successfully');
    }
}
