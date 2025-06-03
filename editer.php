<?php
include 'condb.php';
$idproduct = $_GET['id'] ?? null;
if ($idproduct) {
    $stmt = $pdo->prepare("SELECT * FROM product WHERE idproduct = ?");
    $stmt->execute([$idproduct]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$produit) {
        die("Produit non trouvé");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idproduct = $_POST['idproduct'] ?? null;
    $nameproduct = $_POST['nameproduct'];
    $price = $_POST['price'];
    $descreptionp = $_POST['descreptionp'];
    $idcategorie = $_POST['idcategorie'];

    if ($_FILES['image']['size'] > 0) {
        $image = $_FILES['image']['name'];
        $target = "images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $produit['image'] ?? '';
    }
    if ($idproduct) {
        $stmt = $pdo->prepare("UPDATE product SET 
                             nameproduct = ?, 
                             price = ?, 
                             descreptionp = ?, 
                             image = ?, 
                             idcategorie = ? 
                             WHERE idproduct = ?");
        $stmt->execute([$nameproduct, $price, $descreptionp, $image, $idcategorie, $idproduct]);
    }
    header("Location: afficherproduct.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($produit) ? 'EDITER UN PRODUIT' : 'AJOUTER UN PRODUIT' ?></title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: rgb(25, 93, 105);
        }
        .form-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .img-preview {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="text-center mb-4">
                <?= isset($produit) ? 'EDITER LE PRODUIT (' . $produit['nameproduct'] . ')' : 'AJOUTER UN NOUVEAU PRODUIT' ?>
            </h1>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idproduct" value="<?= $produit['idproduct'] ?? '' ?>">
                
                <div class="mb-3">
                    <label for="idcategorie" class="form-label">Catégorie :</label>
                    <select class="form-select" name="idcategorie" required>
                        <option value="">-- Sélectionnez une catégorie --</option>
                        <?php
                        $stmt = $pdo->query("SELECT * FROM categorie");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($row['idcategorie'] == ($produit['idcategorie'] ?? '')) ? 'selected' : '';
                            echo "<option value='".$row['idcategorie']."' $selected>".$row['nomcategorie']."</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="nameproduct" class="form-label">Nom du produit :</label>
                    <input type="text" class="form-control" name="nameproduct" 
                           value="<?= $produit['nameproduct'] ?? '' ?>" 
                           required maxlength="30">
                </div>
                
                <div class="mb-3">
                    <label for="price" class="form-label">Prix (en DH) :</label>
                    <input type="number" class="form-control" name="price" 
                           value="<?= $produit['price'] ?? '' ?>" 
                           required min="1">
                </div>
                
                <div class="mb-3">
                    <label for="descreptionp" class="form-label">Description :</label>
                    <textarea class="form-control" name="descreptionp" rows="3" 
                              required maxlength="300"><?= $produit['descreptionp'] ?? '' ?></textarea>
                </div>
                
                <div class="mb-4">
                    <label for="image" class="form-label">Image du produit :</label>
                    <input type="file" class="form-control" name="image" accept="image/*" <?= !isset($produit) ? 'required' : '' ?>>
                    
                    <?php if (isset($produit) && !empty($produit['image'])): ?>
                        <div class="mt-2">
                            <p>Image actuelle :</p>
                            <img src="<?= $produit['image'] ?>" class="img-preview">
                            <input type="hidden" name="current_image" value="<?= $produit['image'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg" name="submit">
                        <i class="fas fa-save me-2"></i><?= isset($produit) ? 'Mettre à jour' : 'Enregistrer' ?>
                    </button>
                    <a href="afficherproduct.php" class="btn btn-outline-secondary">
                        <i class="fas fa-list me-2"></i>Voir tous les produits
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="bootstrap.min.js"></script>
</body>
</html>