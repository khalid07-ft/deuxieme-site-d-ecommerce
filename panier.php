<?php
session_start();
include 'condb.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre Panier - SamiExpress</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>

body {
            background: linear-gradient(115deg, #3498db,rgb(129, 161, 194));
        }
        .navbar-brand img {
            height: 40px;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        .card-img-top {
            height: 200px;
            object-fit: contain;
            padding: 10px;
        }
        .card {
            transition: transform 0.3s;
            height: 100%;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .card-body {
            display: flex;
            flex-direction: column;
        }
        .card-text {
            flex-grow: 1;
            overflow: hidden;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
        .price-tag {
            font-weight: bold;
            color: #0d6efd;
            margin: 10px 0;
        }
        .active-filter {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        footer {
    background-color:black;
    color: white;
    padding: 60px 0 30px;
    margin-top: 50px;
}

.footer-logo {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 20px;
    display: inline-block;
}

.footer-logo span {
    color: #0d6efd;
}

.footer-links h5 {
    color: #0d6efd;
    margin-bottom: 20px;
    font-size: 1.2rem;
    font-weight: 600;
}

.footer-links ul {
    list-style: none;
    padding-left: 0;
}

.footer-links li {
    margin-bottom: 10px;
}

.footer-links a {
    color: #adb5bd;
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-links a:hover {
    color: white;
    padding-left: 5px;
}

.social-icons a {
    display: inline-block;
    width: 40px;
    height: 40px;
    background-color: rgba(255,255,255,0.1);
    color: white;
    border-radius: 50%;
    text-align: center;
    line-height: 40px;
    margin-right: 10px;
    transition: all 0.3s ease;
}

.social-icons a:hover {
    background-color:#0d6efd;
    transform: translateY(-3px);
}

.newsletter-form .form-control {
    background-color: rgba(255,255,255,0.1);
    border: none;
    color: white;
}

.newsletter-form .btn {
    background-color: #0d6efd;
    border: none;
}

.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.1);
    padding-top: 20px;
    margin-top: 30px;
}


@media (max-width: 768px) {
    
    .footer-col {
        margin-bottom: 30px;
    }
}</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
              <h3><span>Sami</span><span style="color: #0d6efd">Express</span></h3>
            </a>
</ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="panier.php">
                            <i class="fas fa-shopping-cart"></i>
                            Panier
                            <?php if (!empty($_SESSION['panier'])): ?>
                                <span class="badge bg-info"><?= array_sum(array_column($_SESSION['panier'], 'quantite')) ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
            </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="mb-4">Votre Panier</h1>
        <?php if(empty($_SESSION['panier'])): ?>
            <div class="alert alert-info">Votre panier est vide !</div>
            <a href="afficherproduct.php" class="btn btn-primary">Continuer vos achats</a>
        <?php else: ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Prix unitaire</th>
                                        <th>Quantité</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $totalPanier = 0;
                                    foreach ($_SESSION['panier'] as $item): 
                                        $totalProduit = $item['prix'] * $item['quantite'];
                                        $totalPanier += $totalProduit;
                                    ?>
                                        <tr>
                                            <td>
                                                <img src="images/<?= $item['image'] ?>" width="50" class="me-3">
                                                <?= $item['nom'] ?>
                                            </td>
                                            <td><?= number_format($item['prix'],2) ?> DH</td>
                                            <td>
                                                <form method="post" action="modifier_quantite.php" class="d-inline">
                                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                    <input type="number" name="quantite" value="<?= $item['quantite'] ?>" min="1" class="form-control form-control-sm" style="width: 70px;">
                                                    <button type="submit" class="btn btn-sm btn-outline-primary mt-1">Mettre à jour</button>
                                                </form>
                                            </td>
                                            <td><?= number_format($totalProduit , 2) ?> DH</td>
                                            <td>
                                                <a href="supprimer_panier.php?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Récapitulatif</h5>
                            <hr>
                            <p>Sous-total: <strong><?= number_format($totalPanier, 2) ?> DH</strong></p>
                            <p>Livraison: <strong>Gratuite</strong></p>
                            <hr>
                            <p>Total: <strong><?= number_format($totalPanier, 2) ?> DH</strong></p>
                            <form action="panier.php" method="post">
                            <?php if (isset($_SESSION['user'])): ?>
                                <a href="checkout.php" name="chekout"  class="btn btn-primary w-100 mt-2">Passer votre commande</a>
                            <?php else: ?>
                                <a href="login.php" class="btn btn-warning w-100 mt-2">Se connecter pour passer votre commande</a>
                            <?php endif; ?>
                            </form>
                            <a href="afficherproduct.php" class="btn btn-outline-secondary w-100 mt-2">Continuer vos achats</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script src="bootstrap.min.js"></script>

</body>
</html>
<?php
if (isset($_POST['chekout'])) {
    $id = $_POST['id']; 
    $stmt = $pdo->prepare("SELECT stock FROM product WHERE idproduct = ?");
    $stmt->execute([$id]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produit) {
        $stk = $produit['stock'];
        $qt = $_SESSION['panier'][$id]['quantite'] ; 
        if ($qt > $stk) {
            echo "Stock insuffisant pour cet achat ";
        }
    }
}
?>