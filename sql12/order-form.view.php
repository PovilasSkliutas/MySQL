<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>PHP</title>
    <link rel="stylesheet" href="order-form.css">
</head>
<body>
    <section>
        <h1>Bons de commande</h1>

        <a href="index.php">Retourner à l'accueil</a>

        <!-- Etiquette avec fiche client -->
        <article class="order-form-customer">
            <h2><?= $customer['customerName'] ?></h2>
            <h3><?= $customer['contactFirstName'] ?> <?= $customer['contactLastName'] ?></h3>
            <p><?= $customer['addressLine1'] ?></p>
            <p><?= $customer['addressLine2'] ?></p>
            <p><?= $customer['city'] ?></p>
            <p><?= number_format($customer['totalAmount'], 2) ?></p>
        </article>
        <hr>

        <!-- Le bon de commande -->
        <table class="standard-table">
            <caption>Bon de commande n° <?= $_GET['orderNumber'] ?></caption>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th class="money-column">Prix Unitaire</th>
                    <th>Quantité</th>
                    <th class="money-column">Prix Total</th>
                </tr>
            </thead>
            <!-- Un footer de tableau HTML se positionne AVANT le body ! -->
            <tfoot>
                <tr>
                    <th colspan="3">Montant Total HT</th>
                    <th><?= number_format($customer['totalAmount'], 2) ?> €</th>
                </tr>
                <tr>
                    <th colspan="3">TVA (21 %)</th>
                    <th><?= number_format($customer['totalAmount'] * 0.21, 2) ?> €</th>
                </tr>
                <tr>
                    <th colspan="3">Montant Total TTC</th>
                    <!-- Multiplier par 1.20 revient à ajouter 20% à une variable -->
                    <th><?= number_format($customer['totalAmount'] * 1.21, 2) ?> €</th>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach($orderLines as $orderLine): ?>
                    <tr>
                        <td><?= $orderLine['productName'] ?></td>
                        <td class="money-column"><?= number_format($orderLine['priceEach'], 2) ?> €</td>
                        <td><?= $orderLine['quantityOrdered'] ?></td>
                        <td class="money-column"><?= number_format($orderLine['totalPrice'], 2) ?> €</td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>
</body>
</html>
