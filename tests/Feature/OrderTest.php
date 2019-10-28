<?php

namespace Tests\Feature;

use App\Order;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{

    /** @test  */
    function an_order_has_products()
    {
        $order = new Order();

        $order->addProduct(new Product('tv',40));
        $order->addProduct(new Product('mobile',8));

        $this->assertEquals(2,count($order->getProducts()));
        $this->assertCount(2,$order->getProducts());

    }

    /** @test  */
    function an_order_total_cost()
    {
        $order = new Order();

        $order->addProduct(new Product('tv',40));
        $order->addProduct(new Product('mobile',8));

        $this->assertEquals(48,$order->getTotal());

    }
}
