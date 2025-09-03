<?php

namespace AcmeBasket\Interfaces;

use AcmeBasket\Product;

/**
 * Interface OfferInterface
 *
 * Represents a promotional offer that can modify the subtotal
 * of a basket based on certain conditions.
 */
interface OfferInterface
{
    /**
     * Apply the offer to a list of items and current subtotal.
     *
     * @param Product[] $items   List of products in the basket
     * @param float     $subtotal Current subtotal before discount
     *
     * @return float Updated subtotal after applying offer
     */
    public function apply(array $items, float $subtotal): float;
}
