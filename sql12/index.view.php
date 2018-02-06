<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP</title>
    <link rel="stylesheet" href="order-form.css">
</head>
<body>
    <section>
        <h1>Purchase orders</h1>

        <table class="standard-table">
            <caption>Purchase list</caption>
            <thead>
                <tr>
                    <th>Purchase</th>
                    <th>Date of purchase</th>
                    <th>Required Date</th>
                    <th>Date of delivery</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>totalOrders</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orders as $order): ?>
                    <tr>
                        <td>
                            <a href="order-form.php?orderNumber=<?= $order['orderNumber'] ?>"><?= $order['orderNumber'] ?></a>
                        </td>
                        <td><?= $order['orderDate'] ?></td>
                        <td><?= $order['requiredDate'] ?></td>
                        <td><?= $order['shippedDate'] ?></td>
                        <td><?= $order['status'] ?></td>
                        <td><?= $order['customerName'] ?></td>
                        <td><?= $order['totalOrders'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>
</body>
</html>
