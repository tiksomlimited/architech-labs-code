<?php

namespace App\Basket;

class DeliveryCharges
{
    private array $deliveryRules = [
        ['threshold' => 50, 'charge' => 4.95],
        ['threshold' => 90, 'charge' => 2.95],
        ['threshold' => PHP_INT_MAX, 'charge' => 0]
    ];

    public function getDeliveryCharge(float $totalAmount): float
    {
        foreach ($this->deliveryRules as $rule) {
            if ($totalAmount < $rule['threshold']) {
                return $rule['charge'];
            }
        }

        return 0; // Default to free delivery if no other condition is met
    }
}
