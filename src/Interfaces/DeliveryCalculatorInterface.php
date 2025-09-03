<?php

namespace AcmeBasket\Interfaces;

/**
 * Interface DeliveryCalculatorInterface
 *
 * Defines a contract for calculating delivery costs based on
 * the basket subtotal.
 */
interface DeliveryCalculatorInterface
{
    /**
     * Calculate delivery cost based on subtotal.
     *
     * @param float $subtotal Basket subtotal after discounts
     *
     * @return float Delivery cost
     */
    public function calculate(float $subtotal): float;
}
