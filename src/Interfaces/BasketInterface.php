<?php

namespace AcmeBasket\Interfaces;

use AcmeBasket\Product;

/**
 * Interface BasketInterface
 *
 * Defines the contract for a shopping basket.
 * A basket can add products by code and calculate the total
 * including offers and delivery charges.
 */
interface BasketInterface
{
    /**
     * Add a product to the basket by code.
     *
     * @param string $productCode The code of the product to add.
     */
    public function add(string $productCode): void;

    /**
     * Calculate the total cost of the basket, including offers and delivery.
     *
     * @return float Total price of the basket
     */
    public function total(): float;
}
