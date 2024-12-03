<?php

use PHPUnit\Framework\TestCase;
use App\Basket\Offer;

class OfferTest extends TestCase
{
    public function testApplyOffer()
    {
        $offer = new Offer('R01', 0.5); // Buy one, get one half price

        // Test 1: 3 items (1 pair + 1 single item)
        $productCode = 'R01';
        $count = 3;
        $price = 32.95;
        $result = $offer->applyOffer($productCode, $count, $price);
        $this->assertEqualsWithDelta(82.375, $result, 0.01);

        // Test 2: 2 items (1 pair)
        $count = 2;
        $result = $offer->applyOffer($productCode, $count, $price);
        $this->assertEqualsWithDelta(49.425, $result, 0.01);

        // Test 3: 1 item (no discount)
        $count = 1;
        $result = $offer->applyOffer($productCode, $count, $price);
        $this->assertEqualsWithDelta(32.95, $result, 0.01);

        // Test 4: Product code mismatch
        $productCode = 'B01';
        $result = $offer->applyOffer($productCode, $count, $price);

        // No discount applies
        $this->assertEqualsWithDelta(32.95, $result, 0.01);
    }
}
