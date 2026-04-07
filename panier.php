<?php
session_start();
include 'connexion.php'; // الاتصال بقاعدة البيانات

// التحقق من السلة
$cartEmpty = !isset($_SESSION['cart']) || count($_SESSION['cart']) === 0;
$total_general = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Votre Panier - LunaLux</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
      padding: 30px;
    }

    h2 {
      color: #333;
      font-size: 2rem;
      margin-top: 20px;
    }

    .table th, .table td {
      text-align: center;
      vertical-align: middle;
    }

    .table img {
      border-radius: 8px;
    }

    .table-bordered {
      border: 1px solid #dee2e6;
    }

    .table th {
      background-color: #343a40;
      color: white;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #f2f2f2;
    }

    .btn-success, .btn-danger {
      border-radius: 8px;
    }

    .btn-success:hover, .btn-danger:hover {
      opacity: 0.8;
    }

    img {
      width: 90px;
      height: auto;
      border-radius: 8px;
      transition: transform 0.3s ease;
    }

    img:hover {
      transform: scale(1.05);
    }

    .total {
      text-align: right;
      font-size: 1.5rem;
      margin-top: 20px;
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

    .alert-empty {
      text-align: center;
      margin-top: 40px;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <h2 class="mb-4 text-center">Votre Panier</h2>

  <?php if ($cartEmpty): ?>
    <div class="alert alert-warning alert-empty" role="alert">
      <i class="fas fa-exclamation-circle"></i> Votre panier est vide.
    </div>
  <?php else: ?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Image</th>
          <th>Nom du produit</th>
          <th>Prix</th>
          <th>Quantité</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION['cart'] as $id => $item): 
          $total = $item['price'] * $item['quantity']; 
          $total_general += $total;
        ?>
        <tr>
          <td><img src="image/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>"></td>
          <td><?php echo htmlspecialchars($item['name']); ?></td>
          <td><?php echo number_format($item['price'], 2, ',', ' '); ?> $</td>
          <td>
            <div class="d-flex justify-content-center align-items-center">
              <a href="modifier_quantite.php?action=decrement&id=<?php echo $id; ?>" class="btn btn-outline-secondary btn-sm me-2">-</a>
              <?php echo $item['quantity']; ?>
              <a href="modifier_quantite.php?action=increment&id=<?php echo $id; ?>" class="btn btn-outline-secondary btn-sm ms-2">+</a>
            </div>
          </td>
          <td><?php echo number_format($total, 2, ',', ' '); ?> $</td>
          <td>
            <a href="supprimer.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?');">
              <i class="fas fa-trash"></i> Supprimer
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="total">
      <p><strong>Total général: </strong><?php echo number_format($total_general, 2, ',', ' '); ?> $</p>
    </div>

    <a href="paiement.php" class="btn btn-success btn-lg d-block mx-auto mt-4">
      <i class="fas fa-credit-card"></i> Passer à la caisse
    </a>
  <?php endif; ?>

  <a href="home.php" class="back-button"><i class="fas fa-arrow-left"></i> Retour à la boutique</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>
</html>
