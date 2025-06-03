<?php
session_start();
include 'condb.php';
$user_id = $_SESSION['user']['id'];
$stmt = $pdo->prepare("SELECT COUNT(*) FROM compte WHERE id = ?");
$stmt->execute([$user_id]);
$stmt = $pdo->prepare("INSERT INTO commande (iduser) VALUES (?)");
$stmt->execute([$user_id]);
$commande_id = $pdo->lastInsertId();

foreach ($_SESSION['panier'] as $pr) {
    $pid = $pr['id'];
    $qte = $pr['quantite'];
    $stmt = $pdo->prepare("SELECT stock FROM product WHERE idproduct = ?");
    $stmt->execute([$pid]);
    $product = $stmt->fetch();
    $stmt = $pdo->prepare("INSERT INTO lignec (idpr, qte, idc) VALUES (?, ?, ?)");
    $stmt->execute([$pid, $qte, $commande_id]);
    $nvstock = $product['stock'] - $qte;
    $stmt = $pdo->prepare("UPDATE product SET stock = ? WHERE idproduct = ?");
    $stmt->execute([$nvstock, $pid]);
}

unset($_SESSION['panier']);
header("Location: merci.php?id=$commande_id");
?>
