<?php

namespace App\Basket;

class Basket
{
    /** @var Product[] */
    private array $productCatalogue = [];

    /** @var string[] */
    private array $basket = [];

    private Offer $offer;
    private DeliveryCharges $deliveryCharges;

    public function __construct(Database $db, Offer $offer, DeliveryCharges $deliveryCharges)
    {
        // Assuming getProducts() returns an array of Product objects
        $this->productCatalogue = $db->getProducts();
        $this->offer = $offer;
        $this->deliveryCharges = $deliveryCharges;
    }

    public function add(string $productCode): void
    {
        if (!isset($this->productCatalogue[$productCode])) {
            throw new \InvalidArgumentException("Invalid product code: $productCode");
        }
        $this->basket[] = $productCode;
    }

    public function total(): float
    {
        $subtotal = $this->calculateSubtotal();
        $deliveryCharge = $this->deliveryCharges->getDeliveryCharge($subtotal);
        return round($subtotal + $deliveryCharge, 2);
    }

    public function detailedTotal(): array
    {
        $subtotal = $this->calculateSubtotal();
        $deliveryCharge = $this->deliveryCharges->getDeliveryCharge($subtotal);
        return [
            'subtotal' => $subtotal,
            'deliveryCharge' => $deliveryCharge,
            'total' => round($subtotal + $deliveryCharge, 2),
        ];
    }

    private function calculateSubtotal(): float
    {
        $productCounts = array_count_values($this->basket);
        $total = 0;

        foreach ($productCounts as $code => $count) {
            // Ensure that $this->productCatalogue[$code] is a Product object
            /** @var Product $product */
            $product = $this->productCatalogue[$code];

            // Accessing $product's price
            $price = $product->price;

            // Apply the offer and add to the total
            $total += $this->offer->applyOffer($code, $count, $price);
        }

        return $total;
    }

    // Add the method to access the basket contents for testing
    public function getBasket(): array
    {
        return $this->basket;
    }
}
