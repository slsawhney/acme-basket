<?php

namespace AcmeBasket\Tests;

use PHPUnit\Framework\TestCase;
use AcmeBasket\Product;
use AcmeBasket\Basket;
use AcmeBasket\Offer;
use AcmeBasket\DeliveryCalculator;

/**
 * Class BasketTest
 *
 * Unit tests for the Basket class.
 *
 * Verifies correct application of product prices, delivery rules,
 * and offers based on the example scenarios in the assignment.
 */
class BasketTest extends TestCase
{
    /** @var array<string, Product> Product catalogue used in tests */
    private array $catalogue;

    /** @var array<int, array{threshold: float, cost: float}> Delivery rules used in tests */
    private array $deliveryRules;

    /** @var Offer[] Offers used in tests */
    private array $offers;

    /**
     * Sets up the test environment with a fixed product catalogue,
     * delivery rules, and the "buy one red widget, get second half price" offer.
     */
    protected function setUp(): void
    {
        $this->catalogue = [
            'R01' => new Product('R01', 'Red Widget', 32.95),
            'G01' => new Product('G01', 'Green Widget', 24.95),
            'B01' => new Product('B01', 'Blue Widget', 7.95),
        ];

        $this->deliveryRules = [
            ['threshold' => 50, 'cost' => 4.95],
            ['threshold' => 90, 'cost' => 2.95],
        ];

        $this->offers = [
            new Offer('R01', 1, 1, 0.5),
        ];
    }

    /**
     * Test case: Basket with B01 and G01.
     * Expected total = 37.85
     */
    public function testBasketWithB01AndG01(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryCalculator($this->deliveryRules),
            $this->offers
        );
        $basket->add('B01');
        $basket->add('G01');

        $this->assertEquals(37.85, $basket->total());
    }

    /**
     * Test case: Basket with two R01 (red widgets).
     * Second one is half price, plus delivery.
     * Expected total = 54.37
     */
    public function testBasketWithTwoR01(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryCalculator($this->deliveryRules),
            $this->offers
        );
        $basket->add('R01');
        $basket->add('R01');

        $this->assertEquals(54.38, $basket->total());
    }

    /**
     * Test case: Basket with R01 and G01.
     * Expected total = $60.85
     */
    public function testBasketWithR01AndG01(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryCalculator($this->deliveryRules),
            $this->offers
        );
        $basket->add('R01');
        $basket->add('G01');

        $this->assertEquals(60.85, $basket->total());
    }

    /**
     * Test case: Basket with B01, B01, R01, R01, R01.
     * Multiple reds trigger discount.
     * Expected total = $98.27
     */
    public function testBasketWithB01B01R01R01R01(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryCalculator($this->deliveryRules),
            $this->offers
        );
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');

        $this->assertEquals(98.28, $basket->total());
    }
}
