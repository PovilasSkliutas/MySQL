
<?php

    $pdo = new PDO('mysql:host=localhost;dbname=8group', 'root', 'root');
    $pdo->exec('SET NAMES UTF8');

    $query = $pdo->prepare('SELECT count(customerNumber) as kiek FROM customers WHERE customerNumber= ?');

	$query->execute(array($_POST['clientNumber']));

	$customer_count = $query->fetch(PDO::FETCH_ASSOC);

	if($customer_count['kiek']>0) {
		header("Refresh:1; url=clients.php?okey=0");
		return;
	}


    $sql = 'INSERT INTO customers (customerNumber, customerName, contactFirstName, contactLastName, phone, salesRepEmployeeNumber, addressLine1, city, state, postalCode, country, creditLimit)';
    $sql .= ' VALUES ("'.$_POST['clientNumber'].'", "'.$_POST['clientName'].'", "'.$_POST['contactFirstName'].'", "'.$_POST['contactLastName'].'", "'.$_POST['phone'].'", "'.$_POST['employee'].'", "';
    $sql .= $_POST['addressLine1'].'", "'.$_POST['city'].'", "'.$_POST['state'].'", "'.$_POST['postalCode'].'", "'.$_POST['country'].'", "'.$_POST['creditLimit'].'")';
    echo $sql;

    $query = $pdo->prepare($sql);
    $query->execute();

    header("Refresh:1; url=clients.php?okey=1");

?>
