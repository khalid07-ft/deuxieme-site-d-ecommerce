<?php
session_start();
include 'condb.php';
if (isset($_GET['id'])) {
    $productId =($_GET['id']);
    $stmt = $pdo->prepare("SELECT * FROM product WHERE idproduct = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($product) {
        if (isset($_SESSION['panier'][$productId])) {
            $_SESSION['panier'][$productId]['quantite']++;
        } else {
            $_SESSION['panier'][$productId] = [
                'id' => $productId,
                'nom' => $product['nameproduct'],
                'prix' => $product['price'],
                'quantite' => 1,
                'image' => $product['image']
            ];
        }
        header("Location: afficherproduct.php");
        exit();
    }
}
header("Location: afficherproduct.php?error=1");
exit();
?>