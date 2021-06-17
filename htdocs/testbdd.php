<?php
// Connexion à la base de données
$user = 'www-data';
$pass = 'www-password';
$pdo = new PDO('mysql:host=mysql;dbname=eurovent', $user, $pass);

$stmt = $pdo->prepare("CREATE TABLE `eurovent`.`products` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(25) NOT NULL , `price` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ");
$stmt->execute();

// INSERT

$stmt = $pdo->prepare("INSERT INTO products (name, price) VALUES (?, ?)");

$stmt->execute(["Short", 123]);
$stmt->execute(["Chemise", 321]);
$stmt->execute(["Pantalon", 213]);

// SELECT

$stmt = $pdo->prepare("SELECT name, price FROM products");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($products);