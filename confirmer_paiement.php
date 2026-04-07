<?php
session_start();
include 'connexion.php';

$message = "";
$success = false;

if (isset($_GET['id_commande']) && is_numeric($_GET['id_commande'])) {
    $id_commande = $_GET['id_commande'];

    $query = "SELECT * FROM commandes WHERE id_commande = :id_commande";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_commande', $id_commande, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $commande = $stmt->fetch(PDO::FETCH_ASSOC);
        $montant = 0;

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $id => $item) {
                $stmtProduct = $pdo->prepare("SELECT prix FROM produits WHERE id_produit = :id");
                $stmtProduct->bindParam(':id', $id, PDO::PARAM_INT);
                $stmtProduct->execute();
                $product = $stmtProduct->fetch(PDO::FETCH_ASSOC);
                if ($product) {
                    $montant += $item['quantity'] * $product['prix'];
                }
            }
        }

        $mode_paiement = 'carte';
        $date_paiement = date('Y-m-d H:i:s');
        $statut_paiement = 'payé';

        $insert = $pdo->prepare("INSERT INTO paiements (id_commande, montant, mode_paiement, date_paiement, statut_paiement)
                                 VALUES (:id_commande, :montant, :mode_paiement, :date_paiement, :statut_paiement)");
        $insert->execute([
            ':id_commande'     => $id_commande,
            ':montant'         => $montant,
            ':mode_paiement'   => $mode_paiement,
            ':date_paiement'   => $date_paiement,
            ':statut_paiement' => $statut_paiement
        ]);

        unset($_SESSION['cart']); 
        header("Location: merci.php");
        exit();
    } else {
        $message = " Numéro de commande invalide.";
    }
} else {
    $message = " Aucun numéro de commande reçu.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Erreur de paiement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container text-center mt-5">
        <h2>Erreur</h2>
        <p><?php echo $message; ?></p>
        <a href="home.php" class="btn btn-warning mt-3">Retour à l'accueil</a>
    </div>
</body>
</html>
