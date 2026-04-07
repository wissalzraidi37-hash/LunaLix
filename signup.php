<?php
include 'connexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $name = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tele = $_POST['tel'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if ($password !== $confirm_password) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        // تحقق من وجود البريد الإلكتروني
        $checkEmailQuery = $pdo->prepare("SELECT COUNT(*) FROM clients WHERE email = ?");
        $checkEmailQuery->execute([$email]);
        $emailExists = $checkEmailQuery->fetchColumn();

        if($emailExists) {
            $error = "Ce mail est déjà utilisé. Veuillez entrer un autre.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // إضافة البيانات إلى قاعدة البيانات
            $sql = $pdo->prepare('INSERT INTO clients (nom, prenom, email, telephone, adresse, password) VALUES (?, ?, ?, ?, ?, ?)');
            $sql->execute([$name, $prenom, $email, $tele, $adresse, $hashedPassword]);
            $success = "Informations insérées avec succès.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Inscription - LunaLux</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
      margin: 0; padding: 0;
      font-family: 'Poppins', sans-serif;
    }
    body, html {
      height: 100%;
      background:rgb(249, 245, 240);
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }
    .signup-container {
      margin-top: 550px ;
      max-width: 550px;
      width: 100%;
      background: #fff;
      border-radius: 30px;
      padding: 45px 40px 55px;
      box-shadow:
        0 10px 15px rgba(181, 126, 108, 0.15),
        0 20px 40px rgba(181, 126, 108, 0.2);
      position: relative;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .signup-container:hover {
      transform: translateY(-6px);
      box-shadow:
        0 15px 25px rgba(181, 126, 108, 0.3),
        0 30px 50px rgba(181, 126, 108, 0.35);
    }
    /* Decorative circles */
    .signup-container::before,
    .signup-container::after {
      content: '';
      position: absolute;
      border-radius: 50%;
      filter: blur(100px);
      opacity: 0.12;
      z-index: 0;
    }
    .signup-container::before {
      width: 180px;
      height: 180px;
      background: #b57e6c;
      top: -60px;
      right: -60px;
    }
    .signup-container::after {
      width: 240px;
      height: 240px;
      background: #d1a77a;
      bottom: -80px;
      left: -80px;
    }
    h3 {
      color: #b57e6c;
      font-weight: 700;
      margin-bottom: 35px;
      font-size: 2.3rem;
      letter-spacing: 1.8px;
      text-align: center;
      position: relative;
      z-index: 1;
      text-transform: uppercase;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.07);
    }
    label {
      font-weight: 600;
      color: #6a5d4d;
      display: block;
      margin-bottom: 8px;
      position: relative;
      z-index: 1;
    }
    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="password"] {
      width: 100%;
      padding: 16px 22px;
      margin-bottom: 28px;
      border: 2px solid #d9cfc7;
      border-radius: 50px;
      font-size: 16px;
      color: #6a5d4d;
      background-color: #fdf6f1;
      transition: border-color 0.4s ease, box-shadow 0.4s ease;
      position: relative;
      z-index: 1;
    }
    input::placeholder {
      color: #bba89a;
    }
    input:focus {
      border-color: #b57e6c;
      box-shadow: 0 0 15px rgba(181, 126, 108, 0.6);
      outline: none;
      background-color: #fff;
    }
    button.btn-submit {
      width: 100%;
      padding: 16px;
      background: linear-gradient(90deg, #b57e6c, #d1a77a);
      border: none;
      border-radius: 50px;
      color: white;
      font-weight: 700;
      font-size: 20px;
      letter-spacing: 1px;
      cursor: pointer;
      box-shadow: 0 8px 15px rgba(181, 126, 108, 0.6);
      transition: background 0.3s ease, box-shadow 0.3s ease;
      position: relative;
      z-index: 1;
    }
    button.btn-submit:hover {
      background: linear-gradient(90deg, #d1a77a, #b57e6c);
      box-shadow: 0 10px 20px rgba(209, 167, 122, 0.9);
    }
    .text-center {
      margin-top: 20px;
      font-size: 15px;
      color: #a88d80;
      text-align: center;
      position: relative;
      z-index: 1;
    }
    .text-center a {
      color: #b57e6c;
      font-weight: 700;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .text-center a:hover {
      color: #d1a77a;
      text-decoration: underline;
    }
    .error-msg, .success-msg {
      padding: 14px 24px;
      border-radius: 20px;
      margin-bottom: 28px;
      font-weight: 700;
      position: relative;
      z-index: 1;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .error-msg {
      background-color: #fbeaea;
      color: #b54f4f;
      box-shadow: 0 4px 15px rgba(181, 79, 79, 0.3);
    }
    .success-msg {
      background-color: #e6f4ea;
      color: #2d7a2d;
      box-shadow: 0 4px 15px rgba(45, 122, 45, 0.3);
    }
  </style>
</head>
<body>

<div class="signup-container">
  <h3>Inscription</h3>
  <?php if (isset($error)): ?>
    <div class="error-msg"><?= htmlspecialchars($error) ?></div>
  <?php elseif (isset($success)): ?>
    <div class="success-msg"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>
  <form action="signup.php" method="POST" autocomplete="off">
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" placeholder="Entrez votre nom"  >

    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" >

    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" placeholder="Entrez votre e-mail"autocomplete="email" >

    <label for="tel">Numéro de téléphone</label>
    <input type="tel" id="tel" name="tel" placeholder="Entrez votre numéro de téléphone" >

    <label for="adresse">Adresse</label>
    <input type="text" id="adresse" name="adresse" placeholder="Entrez votre adresse" >

    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" >

    <label for="confirm-password">Confirmer le mot de passe</label>
    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmez votre mot de passe" >

    <button type="submit" class="btn-submit">S'inscrire</button>
  </form>
  <div class="text-center">
    <a href="login.php">Vous avez déjà un compte ? Connectez-vous</a>
  </div>
</div>

</body>
</html>
