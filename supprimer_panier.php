<?php
session_start();
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    if (isset($_SESSION['panier'][$productId])) {
        unset($_SESSION['panier'][$productId]);
    }
}
header("Location: panier.php");
exit();
?>