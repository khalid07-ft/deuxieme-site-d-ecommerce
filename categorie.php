<?php
include 'condb.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css" integrity="sha" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM8z4+2e5c7e5a5b5e5c5e5c5e5c5e5c5e5c5e5c5e5c5e5c5" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            box-shadow: 0 0 50px rgba(0,0,0,0.5);
        }
        .form-label {
            font-size: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="form-container">
    <form action="categorie.php" method="POST">
        <h1 class="text-center m-4">INSERT CATEGORY</h1>
            <div class="mb-3">
                <label for="category" class="form-label">Nom Category :</label>
                <input type="text" class="form-control" name="category" required>
                <label for="description" class="form-label">Description :</label>
                <input type="text" class="form-control" name="description" required>
                <label for="quantite" class="form-label">Quantite :</label>
                <input type="number" class="form-control" name="quantite" required>
            </div>
            <button type="submit" class="btn btn-primary form-control" name="insert">INSERT</button><br>
            <a href="index.php" class="btn btn-outline-secondary form-control">
                        <i class="fas fa-arrow-left me-2"></i>Retour
                    </a>
    </form>
</div>
</div>
</body>
</html>
<?php
if(isset($_POST['insert'])){
    if (empty($_POST['category']) || empty($_POST['description']) || empty($_POST['quantite'])) {
        echo "<script>alert('Please fill in all fields.')</script>";
    } else {
        $category = $_POST['category'];
        $description = $_POST['description'];
        $quantite = $_POST['quantite'];
        $stmt = $pdo->prepare("INSERT INTO categorie(nomcategorie, descriptionc, quantite) VALUES (?, ?, ?)");
        $stmt->execute([$category, $description, $quantite]);
        echo "<script>alert('Insertion successful!')</script>";
        echo "<script>window.location.href = 'index.php';</script>";
}
}
?>