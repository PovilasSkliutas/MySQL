<?php

/*
 * Builds a PDO object acting as a representative for the database connection.
 *
 * The first argument is a Data Source Name (DSN) standing for
 * where to connect. An IP address or domain name can be specified.
 *
 * /!\ Must be lowercase and without spaces /!\
 *
 */
$pdo = new PDO('mysql:host=localhost;dbname=8group', 'root', 'root');

// Sets the PHP <-> MySQL link, data encoded in UTF-8.
$pdo->exec('SET NAMES UTF8');



/*
 * Sets the SQL query, PDO returns a PDOStatement class object.
 * http://www.php.net/manual/fr/class.pdostatement.php
 *
 * This object stands for the SQL query,
 * so we'll call it $query.
 */
$query = $pdo->prepare
(
    'SELECT
    customerName as KlientoPavadinimas,
    contactFirstName,
    contactLastName,
    COUNT(orders.orderNumber) as UzsakymuSkaicius,
    SUM(amount) as IsleistaSuma,
    firstName,
    lastName
    FROM customers
    INNER JOIN orders ON customers.customerNumber = orders.customerNumber
    INNER JOIN payments ON customers.customerNumber = payments.customerNumber
    INNER JOIN employees ON customers.salesRepEmployeeNumber = employees.employeeNumber
    GROUP BY customers.customerNumber
    ORDER BY UzsakymuSkaicius DESC'
);

// Tells PDO to send the query to MySQL.
$query->execute();

/*
 * Gets all the data sended by MySQL.
 *
 * The fetchAll() method returns a two dimensions array :
 * - First dimension is the differents data line
 * - Second dimension is the SQL columns of each data lines
 */
$orders = $query->fetchAll(PDO::FETCH_ASSOC);



include 'clients.view.php';
