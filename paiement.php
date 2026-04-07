<?php
session_start();
include 'connexion.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Panier Vide</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
        <meta http-equiv="refresh" content="4;url=home.php">
    </head>
    <body>
        <div class="container mt-5">
            <div class="alert alert-warning text-center" role="alert">
                <strong>Votre panier est vide !</strong> Vous serez redirigé vers la boutique dans quelques secondes...
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

$totalAmount = 0;
foreach ($_SESSION['cart'] as $id => $item) {
    $stmt = $pdo->prepare("SELECT * FROM produits WHERE id_produit = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $totalAmount += $item['quantity'] * $product['prix'];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page de paiement</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        .payment-page {
            margin-top: 50px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .total-amount {
            font-size: 1.5rem;
            font-weight: bold;
            color: #d4af37;
        }
        .btn-confirm {
            background-color: #d4af37;
            color: white;
            font-size: 1.2rem;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .btn-confirm:hover {
            background-color: #c28d3f;
        }
        .back-button {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container payment-page">
    <h2 class="text-center mb-5">Détails de votre commande</h2>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($_SESSION['cart'] as $id => $item) {
            $stmt = $pdo->prepare("SELECT * FROM produits WHERE id_produit = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                $totalPrice = $item['quantity'] * $product['prix'];
                echo "<tr>
                        <td>" . htmlspecialchars($product['nom_produit']) . "</td>
                        <td>" . $item['quantity'] . "</td>
                        <td>" . number_format($product['prix'], 2, ',', ' ') . "€</td>
                        <td>" . number_format($totalPrice, 2, ',', ' ') . "€</td>
                      </tr>";
            }
        }
        ?>
        </tbody>
    </table>

    <div class="text-right total-amount">
        <p>Total à payer: <?php echo number_format($totalAmount, 2, ',', ' ') . '€'; ?></p>
    </div>

    <h3 class="text-center mb-4">Informations de paiement</h3>
    <form action="confirmer_paiement.php" method="POST">
        <div class="row mb-3">
            <label for="nom" class="col-sm-2 col-form-label">Nom</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="adresse" class="col-sm-2 col-form-label">Adresse</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="adresse" name="adresse" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="payment_method" class="col-sm-2 col-form-label">Méthode de paiement</label>
            <div class="col-sm-10">
                <select class="form-control" id="payment_method" name="payment_method" required>
                    <option value="credit_card">Carte de crédit</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>
        </div>

        <div class="text-center">
        <a href="confirmer_paiement.php?id_commande=1"class="btn-confirm">Confirmer le paiement</a>
        </div>

    </form>

    <div class="text">
        <a href="home.php" class="back-button">← Retour à la boutique</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
