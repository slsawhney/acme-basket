<?php

namespace AcmeBasket;

/**
 * Class Product
 *
 * Represents a product in the Acme Widget catalogue.
 */
class Product
{
    public string $code;
    public string $name;
    public float $price;

    /**
     * Product constructor.
     *
     * @param string $code  Unique product code
     * @param string $name  Product name
     * @param float  $price Product price
     */
    public function __construct(string $code, string $name, float $price)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }
}
