<?php
include 'connexion.php'; 


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $query = "SELECT * FROM produits WHERE id_produit = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $product = null;
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erreur: " . $e->getMessage() . "</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>ID invalide.</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du produit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
    <style>
        body {
            background-color: #fafafa;
            font-family: 'Arial', sans-serif;
            padding: 30px;
        }

        .product-title {
            color: #2d2d2d;
            font-weight: bold;
            font-size: 2.4rem;
            margin-top: 15px;
            text-align: center;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }

        .product-description {
            color: #777;
            font-size: 1.1rem;
            margin-top: 15px;
            text-align: justify;
            line-height: 1.7;
            padding: 0 20px;
        }

        .product-price {
            font-size: 1.8rem;
            color: #d4af37;
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
            padding: 10px 0;
            border-top: 2px solid #d4af37;
            border-bottom: 2px solid #d4af37;
        }

        .product-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            margin-top: 30px;
        }

        .product-card img {
            max-width: 400px;
            width: 100%;
            height: auto;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .product-card img:hover {
            transform: scale(1.05);
        }

        .product-card-info {
            flex: 1;
            padding-left: 20px;
        }

        .product-card-extra {
            background-color: #f9f9f9;
            padding: 20px;
            margin-top: 15px;
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .product-card-extra p {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 10px;
        }

        .btn-style {
            background-color: #d4af37;
            color: white;
            font-size: 1.2rem;
            padding: 14px 28px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-style:hover {
            background-color: #c28d3f;
            transform: translateY(-5px);
        }

        .btn-back {
            background-color: #2d2d2d;
            color: white;
            font-size: 1.2rem;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-back:hover {
            background-color: #444;
            transform: translateY(-5px);
        }

        @media (max-width: 768px) {
            .product-card {
                flex-direction: column;
                align-items: center;
            }

            .product-card img {
                max-width: 80%;
            }

            .product-card-info {
                padding-left: 0;
                text-align: center;
            }

            .btn-style, .btn-back {
                width: 80%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <?php if ($product): ?>
            <div class="product-card">
                <img src="image/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['nom_produit']); ?>">
                <div class="product-card-info">
                    <h2 class="product-title"><?php echo htmlspecialchars($product['nom_produit']); ?></h2>
                    <p class="product-description"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                    <p class="product-price"><?php echo number_format($product['prix'], 2, ',', ' '); ?>$</p>
                    <h4><i class="fas fa-cogs"></i> Spécifications du produit</h4>
                    <p><i class="fas fa-tags"></i> <strong>Catégorie:</strong> <?php echo htmlspecialchars($product['categorie']); ?></p>
                    <p><i class="fas fa-box"></i> <strong>Stock:</strong> <?php echo $product['stock']; ?></p>
                    <a href="ajouter_panier.php?id=<?php echo $id; ?>" class="btn btn-style">
                        <i class="fas fa-cart-plus"></i> Ajouter au panier
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">Produit introuvable.</div>
        <?php endif; ?>
        
        <!-- Bouton de retour à la page principale -->
        <a href="home.php" class="btn btn-back">
            <i class="fas fa-home"></i> Retour à la page d'accueil
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
