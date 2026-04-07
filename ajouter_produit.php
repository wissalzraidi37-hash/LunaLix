<?php
include 'connexion.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_produit = $_POST['nom_produit'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];
    $stock = $_POST['stock'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $nomFichier = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];

        $dossier = 'uploads/';
        if (!is_dir($dossier)) {
            mkdir($dossier, 0755, true);
        }

        $chemin = $dossier . uniqid() . '_' . basename($nomFichier);

        if (move_uploaded_file($tmpName, $chemin)) {
            $req = $pdo->prepare("INSERT INTO produits (nom_produit, description, prix, image, categorie, stock) VALUES (?, ?, ?, ?, ?, ?)");
            if ($req->execute([$nom_produit, $description, $prix, $chemin, $categorie, $stock])) {
                $message = "Produit ajouté avec succès.";
                $alert_class = "alert-success";
            } else {
                $message = "Erreur lors de l'enregistrement dans la base de données.";
                $alert_class = "alert-danger";
            }
        } else {
            $message = "Erreur lors du téléchargement de l'image.";
            $alert_class = "alert-danger";
        }
    } else {
        $message = "Aucune image n’a été téléchargée.";
        $alert_class = "alert-danger";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Montserrat', sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 1200px;
        }
        .card {
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            background-color: #fff;
        }
        .alert {
            margin-top: 20px;
            border-radius: 12px;
            font-size: 1.2rem;
            font-weight: 600;
        }
        .form-control {
            border-radius: 12px;
            background-color: #f8f9fa;
            padding: 15px;
            font-size: 1.1rem;
            border: 1px solid #dcdcdc;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .form-control:focus {
            box-shadow: 0 0 8px rgba(255, 165, 0, 0.8);
        }
        .btn-primary {
            background-color: #e5b94d;
            color: #fff;
            font-size: 1.2rem;
            padding: 15px;
            border-radius: 12px;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #d19834;
            transform: scale(1.05);
        }
        .form-group {
            margin-bottom: 30px;
        }
        .input-file {
            padding: 12px;
            background-color: #f5f5f5;
            border-radius: 12px;
        }
        .form-label {
            font-weight: 600;
            color: #5a5a5a;
        }
        .text-center {
            font-family: 'Courier New', monospace;
            color: #e5b94d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="text-center text-uppercase mb-4">Ajouter un produit</h2>
            <?php if (!empty($message)) : ?>
                <div class="alert <?= $alert_class ?>" role="alert">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>
            <form action="ajouter_produit.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom_produit" class="form-label">Nom du produit</label>
                    <input type="text" class="form-control" id="nom_produit" name="nom_produit" required>
                </div>
                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="prix" class="form-label">Prix</label>
                    <input type="number" class="form-control" id="prix" name="prix" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="categorie" class="form-label">Catégorie</label>
                    <input type="text" class="form-control" id="categorie" name="categorie" required>
                </div>
                <div class="form-group">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>
                <div class="form-group">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control input-file" id="image" name="image" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Ajouter le produit</button>
            </form>
        </div>
    </div>
</body>
</html>
