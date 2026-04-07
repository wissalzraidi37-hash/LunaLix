<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LunaLux - Bijoux</title>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  
 
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color:rgb(255, 255, 255);
    }

    .hero-section {
      background-image: url('image/Classy-White-Sterling-Silver-Alloy-Pearl-Beading-Pendant-Necklace4_1800x1800.webp');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      position: relative;
      height: 100vh; 
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      opacity: 0,5px;
    }

    .overlay {
      background: rgba(0, 0, 0, 0.5);
      padding: 20px;
      text-align: center;
    }

    .hero-section h1 {
      font-size: 3rem;
      font-weight: bold;
      margin-bottom: 20px;
      animation: fadeInUp 1s ease-out;
    }

    .hero-section p {
      font-size: 1.2rem;
      margin-bottom: 30px;
      animation: fadeInUp 1.5s ease-out;
    }

    .btn-style {
      color:#bfa77a;
      border-radius: 20px;
      padding: 12px 24px;
      font-size: 1.2rem;
      transition: background-color 0.3s ease;
    }

  

    .card {
      border: none;
      border-radius: 10px;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-10px);
    }

    .testimonial-section {
      background-color: #f8f9fa;
      padding: 40px 0;
    }

    .testimonial-card {
      border: none;
      border-radius: 10px;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      padding: 30px;
      height: 100%;
    }
    .nav-link:hover{
      color: #d6c8a1;
    }
    .navbar-brand{
      font-size:30px;
      font-weight: bold;
    }
   
    .nav-item a {
      position: relative;
    }

    .badge {
      position: absolute;
      top: -5px;
      right: -5px;
      font-size: 0.8rem;
      padding: 0.3em 0.6em;
    }
   
  </style>
</head>
<body>

  
  <nav class="navbar navbar-expand-lg navbar-light py-3">
    <div class="container">
      <a class="navbar-brand" href="home.php">LunaLux</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Accueil</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="ajouter_produit.php">Ajouter un produit</a>
        </li>
          <li class="nav-item">
            <a class="nav-link" href="paiement.php">paiement</a>
          </li>
          <li class="nav-item">
          <a class="btn btn-style ms-3" href="panier.php" title="Panier">
            <i class="bi bi-bag"></i> 
            </a>
          </li>
          <li class="nav-item">
  <a class="nav-link " href="login.php">
    <i class="bi bi-person-circle me-1"></i> Se connecter
  </a>
</li>
        </ul>
      </div>
    </div>
  </nav> 

 
  <section class="hero-section" data-aos="zoom-in">
    <div class="overlay" data-aos="fade-up">
      <h1 class="animate__animated animate__fadeInUp">Découvrez nos magnifiques bijoux</h1>
      <p class="animate__animated animate__fadeInUp">Offrez-vous le luxe et l'élégance avec LunaLux</p>
    </div>
  </section>

 
<div class="container py-5">
  <h2 class="text-center mb-4" data-aos="fade-up">Produits en Vedette</h2>
  <div id="carouselProduits" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

    
      <div class="carousel-item active">
        <div class="row">
          <div class="col-md-4" data-aos="fade-up">
            <div class="card">
              <img src="image/luxury-shine-diamonds-digital-art_23-2151695047.jpg" class="card-img-top" alt="Produit 1">
              <div class="card-body text-center">
                <h5 class="card-title">Collier Élegant</h5>
                <p class="card-text">Un collier magnifique qui vous apporte de l'élégance et du style.</p>
                <a href="detail.php?id=1" class="btn btn-style">Voir le produit</a>
              </div>
            </div>
          </div>

          <div class="col-md-4" data-aos="fade-up">
            <div class="card">
              <img src="image/jewels-sparkle-golden-wedding-rings-lying-leather_8353-763 (1).jpg" class="card-img-top" alt="Produit 2">
              <div class="card-body text-center">
                <h5 class="card-title">Bague Royale</h5>
                <p class="card-text">Une bague somptueuse qui fait tourner les têtes.</p>
                <a href="detail.php?id=2" class="btn btn-style">Voir le produit</a>
              </div>
            </div>
          </div>

          <div class="col-md-4" data-aos="fade-up">
            <div class="card">
              <img src="image/falling-many-beautiful-jewelry-with-precious-stones-isolated-white-background-luxury-glamorous_613585-49929.jpg" class="card-img-top" alt="Produit 3">
              <div class="card-body text-center">
                <h5 class="card-title">Bracelet Précieux</h5>
                <p class="card-text">Le bracelet parfait pour toute occasion spéciale.</p>
                <a href="detail.php?id=3" class="btn btn-style">Voir le produit</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="carousel-item">
        <div class="row">
          <div class="col-md-4" data-aos="fade-up">
            <div class="card">
              <img src="image/Jewelry-industry-analysis-2024-mobile-banner.jpg" class="card-img-top" alt="Produit 4">
              <div class="card-body text-center">
                <h5 class="card-title">Luxe Subtil </h5>
                <p class="card-text">L'art de la simplicité raffinée</p>
                <a href="detail.php?id=4" class="btn btn-style">Voir le produit</a>
              </div>
            </div>
          </div>

          <div class="col-md-4" data-aos="fade-up">
            <div class="card">
              <img src="image/luxury-diamond-bracelet-jewelry-fashion-brand_360074-53083.avif" class="card-img-top" alt="Produit 5">
              <div class="card-body text-center">
                <h5 class="card-title">Bracelets de luxe </h5>
                <p class="card-text">Distinction et éclat incomparables</p>
                <a href="detail.php?id=5" class="btn btn-style">Voir le produit</a>
              </div>
            </div>
          </div>
        
          <div class="col-md-4" data-aos="fade-up">
            <div class="card">
              <img src="image/istockphoto-954397602-612x612.jpg" class="card-img-top" alt="Produit 6">
              <div class="card-body text-center">
                <h5 class="card-title">Boucles d'oreilles</h5>
                <p class="card-text">Discrètes et élégantes à la fois.</p>
                <a href="detail.php?id=6" class="btn btn-style">Voir le produit</a>
              </div>
            </div>
          </div>
        </div>
      </div>

   
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselProduits" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselProduits" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</div>
  </div>
 
 <section class="py-5" style="background-color: #fdfaf4; ;" data-aos="fade-up">
  <div class="container">
    <h2 class="text-center mb-4" style="color: #333;">Pourquoi choisir <span style="color: #bfa77a;">LunaLux</span> ?</h2>
    <div class="row text-center">
      <div class="col-md-3 mb-4">
        <i class="bi bi-truck fs-1 text-secondary mb-3"></i>
        <h5>Livraison rapide</h5>
        <p>Expédition gratuite et rapide à travers le Maroc.</p>
      </div>
      <div class="col-md-3 mb-4">
        <i class="bi bi-shield-lock fs-1 text-secondary mb-3"></i>
        <h5>Paiement sécurisé</h5>
        <p>Vos informations sont protégées à 100%.</p>
      </div>
      <div class="col-md-3 mb-4">
        <i class="bi bi-gem fs-1 text-secondary mb-3"></i>
        <h5>Qualité premium</h5>
        <p>Des bijoux soigneusement sélectionnés avec une finition parfaite.</p>
      </div>
      <div class="col-md-3 mb-4">
        <i class="bi bi-heart fs-1 text-secondary mb-3"></i>
        <h5>Satisfaction garantie</h5>
        <p>Des clientes heureuses qui nous font confiance chaque jour.</p>
      </div>
    </div>
  </div>
</section>
 
  <script>
    AOS.init();
  </script>
  

<footer class="bg-dark text-white py-5 mt-5">
  <div class="container text-center">
    <h4 class="mb-4">Suivez-nous</h4>
    <div class="d-flex justify-content-center gap-4 mb-4">
      <a href="https://www.twitter.com/yourprofile" class="text-white fs-3" target="_blank"><i class="bi bi-twitter"></i></a>
      <a href="mailto:lunalux.contact@gmail.com" class="text-white fs-3"><i class="bi bi-envelope"></i></a>
      <a href="https://www.facebook.com/yourprofile" class="text-white me-3"><i class="bi bi-facebook fs-4"></i></a>
      <a href="https://www.instagram.com/yourprofile" class="text-white me-3"><i class="bi bi-instagram fs-4"></i></a>
      <a href="https://www.linkedin.com/in/yourprofile" class="text-white me-3"><i class="bi bi-linkedin fs-4"></i></a>
      <a href="tel:+212688169846" class="text-white fs-3"><i class="bi bi-telephone"></i></a>
    </div>
    <div class="footer-decor mx-auto my-3" style="width: 80px; height: 3px; background: #bfa77a; border-radius: 5px;"></div>
    <p class="mb-0">© 2025 LunaLux. Tous droits réservés.</p>
  </div>
</footer>

</body>
</html>
