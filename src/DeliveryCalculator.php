<?php

namespace AcmeBasket;

use AcmeBasket\Interfaces\DeliveryCalculatorInterface;

/**
 * Class DeliveryCalculator
 *
 * Calculates delivery charges based on configured rules.
 * Rules are evaluated in order; the first matching threshold applies.
 */
class DeliveryCalculator implements DeliveryCalculatorInterface
{
    /** @var array<int, array{threshold: float, cost: float}> Delivery rules */
    private array $rules;

    /**
     * DeliveryCalculator constructor.
     *
     * @param array<int, array{threshold: float, cost: float}> $rules Delivery rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * Calculate delivery cost based on subtotal.
     *
     * @param float $subtotal Basket subtotal after discounts
     *
     * @return float Delivery cost
     */
    public function calculate(float $subtotal): float
    {
        foreach ($this->rules as $rule) {
            if ($subtotal < $rule['threshold']) {
                return $rule['cost'];
            }
        }
        return 0.0;
    }
}
