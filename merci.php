<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Merci !</title>
    <link href="bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success">
            <h2>Merci pour votre commande !</h2>
            <p>Votre numéro de commande est : <?php echo $_GET['id']; ?></p>
            <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
        </div>
    </div>
</body>
</html>