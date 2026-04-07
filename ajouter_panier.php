<?php
session_start();
include 'connexion.php'; 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    
    if (isset($_SESSION['cart'][$id])) {
       
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        
        try {
            
            $query = "SELECT * FROM produits WHERE id_produit = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $produit = $stmt->fetch(PDO::FETCH_ASSOC);

                
                $_SESSION['cart'][$id] = [
                    'name' => $produit['nom_produit'],
                    'price' => $produit['prix'],
                    'quantity' => 1,
                    'image' => $produit['image']
                ];
            }
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Erreur: " . $e->getMessage() . "</div>";
            exit;
        }
    }
}
header('Location: panier.php'); 
exit();
?>

