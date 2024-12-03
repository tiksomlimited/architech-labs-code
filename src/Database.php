<?php

namespace App\Basket;

use PDO;

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=architech-labs-db;charset=utf8mb4';
        $username = 'root';
        $password = '';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $this->pdo = new PDO($dsn, $username, $password, $options);
    }

    public function getProducts(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM products');
        $products = [];
        while ($row = $stmt->fetch()) {
            $products[$row['code']] = new Product(
                $row['code'], 
                $row['name'], 
                (float)$row['price']
            );
        }
        return $products;
    }

    public function getProductByCode($code) {
        $stmt = $this->pdo->prepare('SELECT * FROM products WHERE code = ?');
        $stmt->execute([$code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllProducts() {
        $stmt = $this->pdo->query('SELECT * FROM products');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
