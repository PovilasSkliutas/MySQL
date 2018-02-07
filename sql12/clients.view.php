<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP</title>
    <link rel="stylesheet" href="order-form.css">
</head>
<body>
    <section>
        <h1>Klientu uzsakymai</h1>

        <table class="standard-table">
            <caption>Purchase list</caption>
            <thead>
                <tr>
                    <th>Kliento pavadinimas</th>
                    <th>Kontaktas</th>
                    <th>Uzsakymu skaicius</th>
                    <th>Isleistu pinigu suma</th>
                    <th>Darbuotojas</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orders as $order): ?>
                    <tr>
                        <td>
                            <a href="new-client.view.php?edit_id=<?= $order['nr'] ?>"><?= $order['KlientoPavadinimas'] ?></a>
                        </td>
                        <td><?= $order['contactFirstName'].' '.$order['contactLastName'] ?></td>
                        <td><?= $order['UzsakymuSkaicius'] ?></td>
                        <td><?= '$'.' '.number_format($order['IsleistaSuma'],2,',',' ') ?></td>
                        <td><?= $order['firstName'].' '.$order['lastName'] ?></td>
                        <td>
                            <button type="button" name="button">delete</button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>
</body>
</html>
