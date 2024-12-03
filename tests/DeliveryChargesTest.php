<?php

use PHPUnit\Framework\TestCase;
use App\Basket\DeliveryCharges;

class DeliveryChargesTest extends TestCase
{
    public function testGetDeliveryCharge()
    {
        $deliveryCharges = new DeliveryCharges();

        $this->assertEquals(4.95, $deliveryCharges->getDeliveryCharge(30));
        $this->assertEquals(2.95, $deliveryCharges->getDeliveryCharge(60));
        $this->assertEquals(0, $deliveryCharges->getDeliveryCharge(100));
    }
}
