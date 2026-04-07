<?php
session_start();

if (isset($_GET['id'], $_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if (isset($_SESSION['cart'][$id])) {
        if ($action === 'increment') {
            $_SESSION['cart'][$id]['quantity']++;
        } elseif ($action === 'decrement') {
            $_SESSION['cart'][$id]['quantity']--;
            if ($_SESSION['cart'][$id]['quantity'] < 1) {
                unset($_SESSION['cart'][$id]);
            }
        }
    }
}

header('Location: panier.php');
exit;
