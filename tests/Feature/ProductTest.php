<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{

    protected $product;
    public function setUp(): void // run before each test function
    {
        $this->product = new Product('fallout 4',59);
    }
    /** @test */
    public function AProductHasName()
    {
        $this->assertEquals('fallout 4',$this->product->getName());
    }

    public function testAProductHasPrice()
    {
        $this->assertEquals(59,$this->product->getPrice());
    }
}
