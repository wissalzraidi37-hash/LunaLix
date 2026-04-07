<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Merci pour votre achat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fdfcfb;
            font-family: 'Segoe UI', sans-serif;
        }
        .merci-container {
            max-width: 700px;
            margin: 80px auto;
            background-color: white;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        .merci-container h1 {
            color: #d4af37;
            margin-bottom: 20px;
            font-size: 2.8rem;
        }
        .merci-container p {
            font-size: 1.2rem;
            color: #444;
            margin-bottom: 30px;
        }
        .icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 20px;
        }
        .btn-back {
            background-color: #d4af37;
            color: white;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 10px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-back:hover {
            background-color: #b9962f;
        }
    </style>
</head>
<body>

<div class="merci-container">
    <div class="icon">🎁</div>
    <h1>Merci pour votre commande !</h1>
    <p>Votre paiement a été traité avec succès.<br>Nous espérons que vous apprécierez votre achat.</p>
    <a href="home.php" class="btn-back">Continuer vos achats</a>
</div>

</body>
</html>
