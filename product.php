<?php
include 'condb.php';

if(isset($_POST['insert'])) {

    if(empty($_POST['produit']) || empty($_POST['prix']) || empty($_POST['description']) || empty($_FILES['image']['name']) || empty($_POST['category'])) {
        echo "<script>alert('Veuillez remplir tous les champs.');</script>";
    } else {
        $image = "";
        if(isset($_FILES['image'])){
            $image = $_FILES['image']['name'];
            $files = $image;
        }
        try {
            $produit = ($_POST['produit']);
            $prix = $_POST['prix'];
            $description = ($_POST['description']);
            $category_id = $_POST['category'];

            $stmt = $pdo->prepare("INSERT INTO product (nameproduct, price, descreptionp, image, idcategorie) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$produit, $prix, $description, $image, $category_id]);
            
            echo "<script>
                    alert('Produit ajouté avec succès!');
                    window.location.href = 'afficherproduct.php';
                  </script>";
        } 
        catch(PDOException $e) {
            echo "<script>alert('Erreur: ".($e->getMessage())."');</script>";
        }
    } 
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color:rgb(20, 75, 159);
        }
        .form-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="text-center mb-4">Ajouter un Produit</h1>
            
            <form action="product.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie :</label>
                    <select class="form-select" name="category" required>
                        <option value="">-- Sélectionnez une catégorie --</option>
                        <?php
                        $stmt = $pdo->query("SELECT * FROM categorie");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='".$row['idcategorie']."'>".$row['nomcategorie']."</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="produit" class="form-label">Nom du produit :</label>
                    <input type="text" class="form-control" name="produit" required maxlength="30">
                </div>
                
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix (en DH) :</label>
                    <input type="number" class="form-control" name="prix" required min="1">
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description :</label>
                    <textarea class="form-control" name="description" rows="3" required maxlength="300"></textarea>
                </div>
                
                <div class="mb-4">
                    <label for="image" class="form-label">Image du produit :</label>
                    <input type="file" class="form-control" name="image" accept="image/*" required>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg" name="insert">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                    <a href="afficherproduct.php" class="btn btn-outline-secondary">
                        <i class="fas fa-list me-2"></i>Voir tous les produits
                    </a>
                    <a href="index.php" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Retour
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="bootstrap.min.js"></script>
</body>
</html>