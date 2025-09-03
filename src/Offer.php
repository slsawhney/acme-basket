<?php

namespace AcmeBasket;

use AcmeBasket\Interfaces\OfferInterface;

/**
 * Class Offer
 *
 * Represents a specific promotional offer for a product.
 * Example: "buy one, get second half price".
 */
class Offer implements OfferInterface
{
    private string $productCode;
    private int $buyQty;
    private int $discountQty;
    private float $discountRate;

    /**
     * Offer constructor.
     *
     * @param string $productCode Product code the offer applies to
     * @param int    $buyQty      Quantity required to trigger discount
     * @param int    $discountQty Number of items discounted
     * @param float  $discountRate Discount rate (e.g., 0.5 for 50%)
     */
    public function __construct(string $productCode, int $buyQty, int $discountQty, float $discountRate)
    {
        $this->productCode = $productCode;
        $this->buyQty = $buyQty;
        $this->discountQty = $discountQty;
        $this->discountRate = $discountRate;
    }

    /**
     * Apply the offer discount to the given items and subtotal.
     *
     * @param Product[] $items List of products in the basket
     * @param float $subtotal Current subtotal before discount
     *
     * @return float Updated subtotal after applying the offer
     */
    public function apply(array $items, float $subtotal): float
    {
        // Filter only products matching offer
        $matchingProducts = array_filter($items, fn(Product $p) => $p->code === $this->productCode);
        $productCount = count($matchingProducts);

        if ($productCount >= ($this->buyQty + $this->discountQty)) {
            // Get first product safely
            $firstProduct = array_values($matchingProducts)[0]; // always exists because count >= required
            $productPrice = $firstProduct->price;

            $discountableUnits = intdiv($productCount, ($this->buyQty + $this->discountQty)) * $this->discountQty;
            $subtotal -= $discountableUnits * $productPrice * $this->discountRate;
        }

        return $subtotal;
    }
}
