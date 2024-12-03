<?php

require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Product.php';
require_once __DIR__ . '/../src/Offer.php';
require_once __DIR__ . '/../src/DeliveryCharges.php';
require_once __DIR__ . '/../src/Basket.php';

use App\Basket\Database;
use App\Basket\Offer;
use App\Basket\Basket;
use App\Basket\DeliveryCharges;

// Setup database connection
$db = new Database();

// Define the offer: Buy one Red Widget (R01), get the second at half price
$offer = new Offer('R01', 0.5);

// Initialize DeliveryCharges
$deliveryCharges = new DeliveryCharges();

// Initialize basket with offer and delivery charges
$basket = new Basket($db, $offer, $deliveryCharges);

// Function to print all products in the database
function printAllProducts($db) {
    $products = $db->getAllProducts();
    echo "Available Products:\n";
    foreach ($products as $product) {
        echo "Product: " . $product['name'] . " | Code: " . $product['code'] . " | Price: $" . $product['price'] . "\n";
    }
    echo "\n";
}

// Function to print product details
function printProductDetails($productCode, $db) {
    $product = $db->getProductByCode($productCode);
    echo "Product: " . $product['name'] . " | Code: " . $product['code'] . " | Price: $" . $product['price'] . "\n";
}

// Print all available products before the test cases
printAllProducts($db);

// Test Case 1: B01, G01
echo "\nTest Case 1: B01, G01\n";
$basket->add('B01');
$basket->add('G01');
$calculate = $basket->detailedTotal();
echo "Total (B01, G01): $" . $calculate['subtotal']. " + $" .$calculate['deliveryCharge']. " = $" .$calculate['total'] . "\n";

// Test Case 2: R01, R01
echo "\nTest Case 2: R01, R01\n";
$basket = new Basket($db, $offer, $deliveryCharges);
$basket->add('R01');
$basket->add('R01');
$calculate = $basket->detailedTotal();
echo "Total (R01, R01): $" . $calculate['subtotal']. " + $" .$calculate['deliveryCharge']. " = $" .$calculate['total'] . "\n";

// Test Case 3: R01, G01
echo "\nTest Case 3: R01, G01\n";
$basket = new Basket($db, $offer, $deliveryCharges);
$basket->add('R01');
$basket->add('G01');
$calculate = $basket->detailedTotal();
echo "Total (R01, G01): $" . $calculate['subtotal']. " + $" .$calculate['deliveryCharge']. " = $" .$calculate['total'] . "\n";

// Test Case 4: B01, B01, R01, R01, R01
echo "\nTest Case 4: B01, B01, R01, R01, R01\n";
$basket = new Basket($db, $offer, $deliveryCharges);
$basket->add('B01');
$basket->add('B01');
$basket->add('R01');
$basket->add('R01');
$basket->add('R01');
$calculate = $basket->detailedTotal();
echo "Total (B01, B01, R01, R01, R01): $" . $calculate['subtotal']. " + $" .$calculate['deliveryCharge']. " = $" .$calculate['total'] .  "\n";
