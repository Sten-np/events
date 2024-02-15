<?php

namespace Tests\Feature;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    public function test_cart_page_loads_correctly()
    {
        $response = $this->get('/cart');
        $response->assertStatus(200);
    }

    public function test_cart_page_contains_no_products_message()
    {
        $response = $this->get('/cart');

        $response->assertStatus(200);
        $response->assertDontSee('No products in the cart');
    }

    public function test_cart_page_contains_products_in_cart()
    {
        Cart::add(1, 'Product 1', 1, 9.99);
        Cart::add(2, 'Product 2', 2, 24.99);

        $response = $this->get('/cart');

        $response->assertStatus(200);
        $response->assertDontSee('No products in the cart');
        $response->assertSee('Product 1');
        $response->assertSee('Product 2');
    }

}
