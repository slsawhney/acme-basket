<?php

namespace AcmeBasket;

use AcmeBasket\Interfaces\BasketInterface;
use AcmeBasket\Interfaces\OfferInterface;
use AcmeBasket\Interfaces\DeliveryCalculatorInterface;

/**
 * Class Basket
 *
 * Represents a shopping basket.
 * Responsible for adding products, applying offers, and calculating
 * the total price including delivery.
 */
class Basket implements BasketInterface
{
    /**
     * @var Product[] Associative array of products by code
     */
    private array $catalogue;

    /**
     * @var OfferInterface[]
     */
    private array $offers;

    private DeliveryCalculatorInterface $deliveryCalculator;

    /**
     * @var Product[] List of items added to basket
     */
    private array $items = [];

    /**
     * Basket constructor.
     *
     * @param Product[] $catalogue Associative array of products by code
     * @param DeliveryCalculatorInterface $deliveryCalculator
     * @param OfferInterface[] $offers
     */
    public function __construct(
        array $catalogue,
        DeliveryCalculatorInterface $deliveryCalculator,
        array $offers = []
    ) {
        $this->catalogue = $catalogue;
        $this->deliveryCalculator = $deliveryCalculator;
        $this->offers = $offers;
    }

    /**
     * Add a product to the basket by product code.
     *
     * @param string $productCode
     * @throws \InvalidArgumentException
     */
    public function add(string $productCode): void
    {
        if (!isset($this->catalogue[$productCode])) {
            throw new \InvalidArgumentException("Unknown product code: {$productCode}");
        }
        $this->items[] = $this->catalogue[$productCode];
    }

    /**
     * Calculate the total cost of the basket including offers and delivery.
     *
     * @return float Total cost rounded to 2 decimals
     */
    public function total(): float
    {
        // Sum product prices.
        $subtotal = array_reduce(
            $this->items,
            fn(float $sum, Product $product): float => $sum + $product->price,
            0.0
        );

        // Apply offers.
        foreach ($this->offers as $offer) {
            $subtotal = $offer->apply($this->items, $subtotal);
        }

        // Round subtotal after offers.
        $subtotal = round($subtotal, 2);

        // Calculate delivery based on rounded subtotal.
        $deliveryCost = $this->deliveryCalculator->calculate($subtotal);

        // Return total rounded to 2 decimals.
        return round($subtotal + $deliveryCost, 2);
    }
}
