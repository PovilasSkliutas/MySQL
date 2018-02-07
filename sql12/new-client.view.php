<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="utf-8">
    <title>PHP</title>
    <link rel="stylesheet" href="order-form.css">
    <style type="text/css">
        input {width: 90%; padding: 10px;}
        select {width: 93%; padding: 10px;}
        label {width: 100%; text-align: center; padding-right: 15px; display: block; font-weight: 800; margin-top: 15px;}
    </style>
</head>

<?php
    $pdo = new PDO('mysql:host=localhost;dbname=8group', 'root', 'root');
    $pdo->exec('SET NAMES UTF8');
    $query = $pdo->prepare
    (
        'SELECT employeeNumber, firstName, lastName
        FROM employees
        ORDER BY firstName'
    );
    $query->execute();
    $employees = $query->fetchAll(PDO::FETCH_ASSOC);

    // kliento duomenu redagavimas
    if(isset($_GET['edit_id'])) {
        $query = $pdo->prepare
        (
            'SELECT customerNumber, customerName, contactFirstName, contactLastName, phone, addressLine1, city, state, postalCode, country, creditLimit, salesRepEmployeeNumber FROM customers WHERE customerNumber = ?'
        );
        $query->execute(array($_GET['edit_id']));
        $edit_client = $query->fetch(PDO::FETCH_ASSOC);
    }
 ?>

<body>
    <section>
        <h1>Klientų įvedimas</h1>

        <?php if(isset($_GET['edit_id'])) { ?>
            <form action="new-client-update.php" method="POST">
        <?php } else { ?>
            <form action="new-client.php" method="POST">
        <?php } ?>

            <form action="new-client.php" method="POST">
                <div style="width: 50%; float: left;">
                    <label>Kliento Nr.</label>
                    <input type="number" name="clientNumber" min="0" step="1" value="<?=$edit_client['customerNumber']; ?>">
                    <label>Kliento pavad.</label>
                    <input type="text" name="clientName" value="<?=$edit_client['clientName']; ?>">
                    <label>Kontakto vardas </label>
                    <input type="text" name="contactFirstName" value="<?=$edit_client['contactFirstName']; ?>">
                    <label>Kontakto pavardė</label>
                    <input type="text" name="contactLastName" value="<?=$edit_client['contactLastName']; ?>">
                    <label>Tel.</label>
                    <input type="text" name="phone" value="<?=$edit_client['phone']; ?>">
                    <label>Darbuotojas</label>
                    <select name="employee">
                       <?php foreach($employees as $var) {
                           echo "<option value='".$var['employeeNumber']."'";

                           if ($edit_client['salesRepEmployeeNumber'] == $var['employeeNumber']) {
                               echo " SELCTED ";
                           }
                           echo ">".$var['firstName']." ".$var['lastName']."</options>";
                       } ?>
                   </select>
                </div>
                <div style="width: 50%; float: right;">
                    <label>Adresas</label>
                    <input type="text" name="addressLine1" value="<?=$edit_client['addressLine1']; ?>">
                    <label>Miestas</label>
                    <input type="text" name="city" value="<?=$edit_client['city']; ?>">
                    <label>STATE</label>
                    <input type="text" name="state" value="<?=$edit_client['state']; ?>">
                    <label>ZIP</label>
                    <input type="text" name="postalCode" value="<?=$edit_client['postalCode']; ?>">
                    <label>Šalis</label>
                    <input type="text" name="country">
                    <label>Kredito limitas</label>
                    <input type="number" name="creditLimit" min="0" step="1" value="<?=$edit_client['creditLimit']; ?>">
                </div>
                <div style="width: 100%; text-align: center;">
                    <input type="submit" name="Įrašyti" style="margin-top: 25px;">
                </div>
            </form>
    </section>
</body>
</html>
