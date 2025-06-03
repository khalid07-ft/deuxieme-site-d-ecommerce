<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['quantite'])) {
    $productId = $_POST['id'];
    $quantite = $_POST['quantite'];
    if (isset($_SESSION['panier'][$productId]) && $quantite > 0) {
        $_SESSION['panier'][$productId]['quantite'] = $quantite;
    }
}
header("Location: panier.php");
exit();
?>