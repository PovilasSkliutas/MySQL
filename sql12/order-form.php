<?php

$pdo = new PDO('mysql:host=localhost;dbname=classicmodels', 'root', 'root');

// Sets the PHP <-> MySQL link, data encoded in UTF-8.
$pdo->exec('SET NAMES UTF8');



// Récupération de la fiche client.
$query = $pdo->prepare
(
    'SELECT
        customerName,
        contactFirstName,
        contactLastName,
        addressLine1,
        addressLine2,
        city,
        SUM(priceEach * quantityOrdered) AS totalAmount
        FROM customers
        INNER JOIN orders ON orders.customerNumber = customers.customerNumber
        INNER JOIN orderdetails ON orders.orderNumber = orderdetails.orderNumber
        WHERE orders.orderNumber = :orderNumber
        GROUP BY orders.orderNumber'
);

$query->execute(array(':orderNumber'=>$_GET['orderNumber']));

/*
 * Gets all the data sended by MySQL.
 *
 * The fetch() returns a single dimension array:
 * -  the first dimension  is the SQL columns.
 */
$customer = $query->fetch(PDO::FETCH_ASSOC);


// Gets all the orders' lines.
$query = $pdo->prepare
(
    'SELECT
        productName,
        priceEach,
        quantityOrdered,
        priceEach * quantityOrdered AS totalPrice
     FROM orderdetails
     INNER JOIN products ON products.productCode = orderdetails.productCode
     WHERE orderNumber = ?
     ORDER BY orderLineNumber' // Order by line number
);

$query->execute(array($_GET['orderNumber']));

$orderLines = $query->fetchAll(PDO::FETCH_ASSOC);


// Get the total amount.
// $query = $pdo->prepare
// (
//     'SELECT SUM(priceEach * quantityOrdered) AS totalAmount
//      FROM orderdetails
//      WHERE orderNumber = ?'
// );
//
// $query->execute(array($_GET['orderNumber']));

//$result = $query->fetch(PDO::FETCH_ASSOC);

// Creates a variable containing the tax-free total amount.
//$totalAmount = $result['totalAmount'];


include 'order-form.view.php';
