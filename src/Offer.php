<?php

namespace App\Basket;

class Offer
{
    private string $offerCode;
    private float $offerDiscount;

    // add comments regarding this class 
    public function __construct(string $offerCode, float $offerDiscount)
    {
        $this->offerCode = $offerCode;
        $this->offerDiscount = $offerDiscount;
    }

    public function applyOffer(string $productCode, int $count, float $price): float
    {
        if ($productCode !== $this->offerCode) {
            // No offer applies to this product
            return $price * $count;
        }

        // Calculate "Buy one, get one half price" offer
        $eligiblePairs = intdiv($count, 2);  // Number of eligible pairs
        $remainingItems = $count % 2;    // Remaining items not in a pair
        return round(($eligiblePairs * ($price + $price / 2)) + ($remainingItems * $price), 3);
    }
}
