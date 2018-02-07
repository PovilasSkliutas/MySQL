
<?php
	$pdo = new PDO('mysql:host=localhost;dbname=8group', 'root', 'root');
	$pdo->exec('SET NAMES UTF8');

	$sql = "UPDATE customers SET customerName='".$_POST['clientName']."', contactFirstName='".$_POST['contactFirstName']."', contactLastName='".$_POST['contactLastName']."', phone='".$_POST['phone']."', city='".$_POST['city']."', state='".$_POST['state']."', postalCode='".$_POST['postalCode']."', country='".$_POST['country']."', creditLimit='".$_POST['creditLimit']."', addressLine1='".$_POST['addressLine1']."', salesRepEmployeeNumber='".$_POST['employee']."' WHERE customerNumber = ?";

	$query = $pdo->prepare($sql);
	$query->execute(array($_POST['clientNumber']));

	header("Refresh:1; url=clients.php?okey=1");

?>
