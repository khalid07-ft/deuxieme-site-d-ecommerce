<?php
session_start();
include 'condb.php';
$commande_id = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Commande confirmée</title>
</head>
<body>
    <h1>Merci pour votre commande !</h1>
    <p>Votre commande n°<?php echo $commande_id; ?> a été enregistrée.</p>
    <a href="index.php">Retour à l'accueil</a>
</body>
</html>