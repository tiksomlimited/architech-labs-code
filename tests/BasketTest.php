<?php

use PHPUnit\Framework\TestCase;
use App\Basket\{
    DeliveryCharges,
    Database,
    Basket,
    Offer,
};

class BasketTest extends TestCase
{
    private Database $db;
    private Offer $offer;
    private DeliveryCharges $deliveryCharges;
    private Basket $basket;

    protected function setUp(): void
    {
        // Setup the Database connection
        $this->db = new Database();
        
        // Define the offer: Buy one Red Widget (R01), get the second at half price
        $this->offer = new Offer('R01', 0.5);
        
        // Initialize DeliveryCharges
        $this->deliveryCharges = new DeliveryCharges();
        
        // Initialize with real Database connection
        $this->basket = new Basket($this->db, $this->offer, $this->deliveryCharges);
    }

    public function testAddProduct(): void
    {
        $this->basket->add('B01');
        $this->basket->add('G01');
        $this->assertCount(2, $this->basket->getBasket());
    }

    public function testTotal(): void
    {
        $this->basket->add('B01');
        $this->basket->add('G01');
        $this->assertEqualsWithDelta(37.85, $this->basket->total(), 0.01);
    }

    public function testDetailedTotal(): void
    {
        // Test with the offer applied
        $this->basket->add('R01');
        $this->basket->add('R01');
        $detailedTotal = $this->basket->detailedTotal();
        $this->assertEqualsWithDelta(54.38, $detailedTotal['total'], 0.01);
    }

    public function testApplyOfferOnMultipleProducts(): void
    {
        // Adding more products
        $this->basket->add('B01');
        $this->basket->add('B01');
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->assertEqualsWithDelta(98.28, $this->basket->total(), 0.01);
    }

    public function testInvalidProductCodeThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->basket->add('InvalidCode');
    }
}