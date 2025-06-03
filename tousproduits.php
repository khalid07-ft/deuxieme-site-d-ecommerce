<?php
require_once 'condb.php';
$stmt = $pdo->prepare("SELECT * FROM product");
$stmt->execute();
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap.min.css" rel="stylesheet">
    <title>Affichage des Produits</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 80%; border-collapse: collapse; margin: 20px auto; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .actions a { margin: 0 5px; }
    </style>
</head>
<body>
    <table class="table me-4 m-0">
        <thead>
            <tr>
                <th>id product</th>
                <th>name product</th>
                <th>price</th>
                <th>description</th>
                <th>id category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $product): ?>
                <tr>
                    <td><?= ($product['idproduct']) ?></td>
                    <td><?= ($product['nameproduct']) ?></td>
                    <td><?= ($product['price']) ?></td>
                    <td><?= ($product['descreptionp']) ?></td>
                    <td><?= ($product['idcategorie']) ?></td>
                    <td class="actions">
                        <a class="btn btn-warning btn-sm" href="delete.php?id=<?= $product['idproduct'] ?>">Supprimer</a>
                        <a class="btn btn-success btn-sm" href="editer.php?id=<?= $product['idproduct'] ?>">Modifier</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>