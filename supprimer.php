<?php
session_start();

// التحقق من وجود ID في الرابط
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // التحقق من وجود المنتج في السلة
    if (isset($_SESSION['cart'][$id])) {
        // إزالة المنتج من السلة
        unset($_SESSION['cart'][$id]);
    }
}

// إعادة توجيه المستخدم إلى صفحة السلة بعد الحذف
header('Location: panier.php');
exit();
?>
