<?php


namespace App;


class Order
{
    private $products = [];

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }


    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->getPrice();
        }
        return $total;
    }


}