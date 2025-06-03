<?php
include 'condb.php';
if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
    $stmt = $pdo->prepare("DELETE FROM product WHERE idproduct = ?");
    $stmt->execute([$_GET['id']]);
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Produit supprimé avec succès!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Erreur lors de la suppression du produit.'); window.history.back();</script>";
    }
} else {
    echo "<script>
        if (confirm('Êtes-vous sûr de vouloir supprimer ce produit?')) {
            window.location.href = 'delete.php?id=" . $_GET['id'] . "&confirm=yes';
        } else {
            window.history.back();
        }
    </script>";
}
?>

