<?php

require __DIR__ . '/vendor/autoload.php';

use AcmeBasket\Product;
use AcmeBasket\Basket;
use AcmeBasket\Offer;
use AcmeBasket\DeliveryCalculator;

$catalogue = [
    'R01' => new Product('R01', 'Red Widget', 32.95),
    'G01' => new Product('G01', 'Green Widget', 24.95),
    'B01' => new Product('B01', 'Blue Widget', 7.95),
];

$deliveryRules = [
    ['threshold' => 50, 'cost' => 4.95],
    ['threshold' => 90, 'cost' => 2.95],
];

$deliveryCalculator = new DeliveryCalculator($deliveryRules);

$offers = [
    new Offer('R01', 1, 1, 0.5),
];

$basket = new Basket($catalogue, $deliveryCalculator, $offers);

$basket->add('B01');
$basket->add('G01');

echo "Total: $" . $basket->total() . PHP_EOL;
