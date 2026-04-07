<?php
session_start();
include('connexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = $pdo->prepare('SELECT * FROM clients WHERE email = ?');
    $sql->execute([$email]);

    $user = $sql->fetch();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['id_client'] = $user['id_client'];
            header("Location: home.php");
            exit();
        } else {
            $error = "Mot de passe invalide!";
        }
    } else {
        $error = "Email invalide!";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Connexion - LunaLux</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
  <style>
    /* Reset */
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
    .login-wrapper {
      max-width: 400px;
      width: 100%;
      background: #fff;
      border-radius: 30px;
      padding: 50px 40px 60px;
      box-shadow:
        0 10px 15px rgba(181, 126, 108, 0.15),
        0 20px 40px rgba(181, 126, 108, 0.2);
      position: relative;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .login-wrapper:hover {
      transform: translateY(-8px);
      box-shadow:
        0 15px 25px rgba(181, 126, 108, 0.3),
        0 30px 50px rgba(181, 126, 108, 0.35);
    }
    /* Decorative circles */
    .login-wrapper::before,
    .login-wrapper::after {
      content: '';
      position: absolute;
      border-radius: 50%;
      filter: blur(100px);
      opacity: 0.15;
      z-index: 0;
    }
    .login-wrapper::before {
      width: 180px;
      height: 180px;
      background: #b57e6c;
      top: -60px;
      right: -60px;
    }
    .login-wrapper::after {
      width: 240px;
      height: 240px;
      background: #d1a77a;
      bottom: -80px;
      left: -80px;
    }
    h1 {
      color: #b57e6c;
      font-weight: 700;
      margin-bottom: 35px;
      font-size: 2.5rem;
      letter-spacing: 2px;
      text-transform: uppercase;
      position: relative;
      z-index: 1;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.07);
    }
    .form-input {
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
    .form-input::placeholder {
      color: #bba89a;
    }
    .form-input:focus {
      border-color: #b57e6c;
      box-shadow: 0 0 15px rgba(181, 126, 108, 0.6);
      outline: none;
      background-color: #fff;
    }
    .btn-submit {
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
    .btn-submit:hover {
      background: linear-gradient(90deg, #d1a77a, #b57e6c);
      box-shadow: 0 10px 20px rgba(209, 167, 122, 0.9);
    }
    .error-msg {
      background-color: #fbeaea;
      color: #b54f4f;
      padding: 14px 24px;
      margin-bottom: 28px;
      border-radius: 20px;
      font-weight: 700;
      box-shadow: 0 4px 15px rgba(181, 79, 79, 0.3);
      position: relative;
      z-index: 1;
    }
    .signup-text {
      margin-top: 28px;
      font-size: 15px;
      color: #a88d80;
      position: relative;
      z-index: 1;
    }
    .signup-text a {
      color: #b57e6c;
      font-weight: 700;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .signup-text a:hover {
      color: #d1a77a;
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="login-wrapper">
  <h1>connexion</h1>
  <?php if(isset($error)): ?>
    <div class="error-msg"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <form action="login.php" method="POST" autocomplete="off">
    <input type="email" name="email" class="form-input" placeholder="Adresse e-mail" autocomplete="email" />
    <input type="password" name="password" class="form-input" placeholder="Mot de passe"  />
    <button type="submit" class="btn-submit">Se connecter</button>
  </form>
  <p class="signup-text">Pas de compte ? <a href="signup.php">Inscrivez-vous ici</a></p>
</div>

</body>
</html>
