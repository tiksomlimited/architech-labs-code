# Basket Project

## Description
This PHP application implements a basket system with the following features:
- Product catalog management.
- Delivery charge rules based on the total amount spent.
- Special offers, such as "Buy one red widget, get the second at half price".

## Features
- **Product Catalog**: Stores product details (code, name, price).
- **Delivery Charges**: Calculates delivery fees based on the total basket amount.
- **Offers**: Includes a special offer for Red Widget (R01) where buying one gets the second at half price.

## How to Run
1. Clone the repository and navigate to the project directory.

2. Import the SQL schema:
   ```bash
   mysql -u root -p < sql/schema.sql
3. Run the tests/test.php file in a PHP environment:
   ```bash
   php tests/test.php

## File Structure
~~~
    basket_project/  
  │  
  ├── src/  
  │   ├── Database.php # Database connection and query handling  
  │   ├── Offer.php # Offer logic (e.g., buy one, get one half price)  
  │   ├── Product.php # Product definition (code, name, price)  
  │   ├── DeliveryCharges.php # Delivery charge rules  
  │   └── Basket.php # Basket logic, adding items and calculating total 
  │   
  ├── sql/  
  │   └── schema.sql # SQL schema to create the database and Products tables  
  │   
  ├── tests/  
  │   └── test.php # Test of functionality
  │  
  └── README.md   # Project documentation
~~~


## Class Breakdown
* **Product Class** (`src/Product.php`): Defines product attributes (code, name, price). 
* **Database Class** (`src/Database.php`): Manages MySQL connection and retrieves products from the database.
* **Offer Class** (src/Offer.php): The `Offer` class handles special offers for products in the shopping basket. 
  * If the product code matches the offer, it calculates the total cost of the items, applying the "Buy one, get one half price" offer:
    * For every two items purchased, the second item is charged at half price.
    * If there is an odd number of items, the remaining item is charged at the full price.
* **DeliveryCharges** Class (src/DeliveryCharges.php): Calculates delivery charges based on basket total.
* **Basket Class** (src/Basket.php): Handles the shopping basket, including adding products and calculating the final total.
  
## Testing 
- Run `tests/test.php` to test the functionality of the basket, including the offer and delivery charges.
- To run PHPunit collectively
  ```bash
  vendor/bin/phpunit
- To run PHPunit independently
  - For Basket
    ```bash
    vendor/bin/phpunit --bootstrap vendor/autoload.php tests/BasketTest.php
  - For Database
    ```bash
    vendor/bin/phpunit --bootstrap vendor/autoload.php tests/DatabaseTest.php
  - For Offer ``
    ```bash
    vendor/bin/phpunit --bootstrap vendor/autoload.php tests/OfferTest.php

## Database Setup
The SQL schema (`sql/schema.sql`) creates the database `architech-labs-db` and inserts sample products into the `products` table.

## Assumptions
- The classes (`Product`, `Offer`, `DeliveryCharges`, `Basket`, `Database`) are designed to work as per the requirements outlined in the test and are used within the test script (`tests/test.php`).
- Since no specific instructions were given for CRUD operations on the products or on basket, the product data was seeded directly into the database through the `sql/schema.sql` file. These products are then used in the test script to show the functionality.