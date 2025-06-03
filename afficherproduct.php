<?php
include 'condb.php';
$categoryFilter = isset($_GET['idcategorie']) ? $_GET['idcategorie'] : null; 
session_start();
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}
$pricefiltre = isset($_GET['order']) ? $_GET['order'] : null; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Produits</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #3498db, #2b4f72);
        }
        body {
            background: linear-gradient(135deg, #3498db, #2b4f72);
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
            padding: 30px 0 30px;
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
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
            margin-top: 30px;
        }
        .disabled {
            pointer-events: none;
            opacity: 0.6;
        }
        .btn-details {
            background-color: #6c757d;
            color: white;
            margin-top: 10px;
        }
        .btn-details:hover {
            background-color: #5a6268;
            color: white;
        }
        .modal-body img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
              <h3><span>Sami</span><span style="color: #0d6efd">Express</span></h3>
            </a>
            <div class="collapse navbar-collapse" id="navbarContent">
                <form class="d-flex mx-auto" action="afficherproduct.php" method="GET">
                    <div class="input-group" style="width: 280px;">
                        <input type="text" class="form-control" name="search" placeholder="Rechercher un produit...">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <ul class="navbar-nav me-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown">
                            <i class="fas fa-list me-1"></i> Catégories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $stmt = $pdo->query("SELECT * FROM categorie");
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $activeClass = ($categoryFilter == $row['idcategorie']) ? 'active-filter' : '';
                                echo '<li><a class="dropdown-item '.$activeClass.'" href="afficherproduct.php?idcategorie=' . $row['idcategorie'] . '">' . $row['nomcategorie'] . '</a></li>';
                            }
                            ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="afficherproduct.php">Toutes les catégories</a></li>
                        </ul>
                    </li>
                </ul>
                
                <ul class="navbar-nav ms-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownFilter">
                            <i class="fa-solid fa-filter"></i> Filtrer par prix
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="afficherproduct.php?idcategorie=<?= $_GET['idcategorie'] ?? '' ?>&order=desc">
                                    Plus cher
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="afficherproduct.php?idcategorie=<?= $_GET['idcategorie'] ?? '' ?>&order=asc">
                                    Moins cher
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="afficherproduct.php?idcategorie=<?= $_GET['idcategorie'] ?? '' ?>">
                                    Tous les prix
                                </a>
                            </li>
                        </ul>
                    </li>
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
    </nav>
    <div class="container mt-2">
    <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                Produit ajouté au panier avec succès!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                Une erreur s'est produite lors de l'ajout au panier.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <h1 class="text-center mb-5">NOS PRODUITS</h1>    
        <div class="row">
            <?php
                $order = isset($_GET['order']) ? $_GET['order'] : null; 
                $sql = "SELECT p.*, c.nomcategorie 
                        FROM product p 
                        JOIN categorie c ON p.idcategorie = c.idcategorie 
                        WHERE 1=1";

                $params = [];

                if ($categoryFilter) {
                    $sql .= " AND p.idcategorie = ?";
                    $params[] = $categoryFilter;
                }
                if ($order === 'asc') {
                    $sql .= " ORDER BY p.price ASC";
                } elseif ($order === 'desc') {
                    $sql .= " ORDER BY p.price DESC";
                } else {
                    $sql .= " ORDER BY p.idproduct DESC";
                }
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);
                
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $disabled = ($row['stock'] <= 0) ? 'disabled' : '';
                        $btnClass = ($row['stock'] <= 0) ? 'btn-secondary' : 'btn-primary';
                        
                        echo '<div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="images/' . $row['image'] . '" class="card-img-top" alt="' . $row['nameproduct'] . '">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $row['nameproduct'] . '</h5>
                                        <p class="text-muted">Catégorie: ' . $row['nomcategorie'] . '</p>
                                        <p class="card-text">' . substr($row['descreptionp'], 0, 100) . '...</p>
                                        <p class="price-tag">' . $row['price'] . ' DH</p>
                                        <div class="d-flex flex-column">';
                        
                        if ($row['stock'] <= 0) {
                            echo '<button class="btn ' . $btnClass . ' mb-2" disabled>
                                    <i class="fas fa-times-circle me-1"></i> En rupture de stock
                                  </button>';
                        } else {
                            echo '<a href="ajouter_panier.php?id=' . $row['idproduct'] . '" class="btn ' . $btnClass . ' mb-2">
                                    <i class="fas fa-cart-plus me-1"></i> Ajouter au Panier
                                  </a>';
                        }
                        
                        echo '<button type="button" class="btn btn-details" data-bs-toggle="modal" data-bs-target="#productModal' . $row['idproduct'] . '">
                                <i class="fas fa-eye me-1"></i> Voir détails
                              </button>
                            </div>
                        </div>
                    </div>
                </div>';
                        echo '<div class="modal fade" id="productModal' . $row['idproduct'] . '" tabindex="-1" aria-labelledby="productModalLabel' . $row['idproduct'] . '" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="productModalLabel' . $row['idproduct'] . '">' . $row['nameproduct'] . '</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img src="images/' . $row['image'] . '" class="img-fluid" alt="' . $row['nameproduct'] . '">
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Catégorie:</strong> ' . $row['nomcategorie'] . '</p>
                                                    <p><strong>Prix:</strong> ' . $row['price'] . ' DH</p>
                                                    <p><strong>Stock:</strong> ' . $row['stock'] . ' disponible(s)</p>
                                                    <hr>
                                                    <h5>Description:</h5>
                                                    <p>' . $row['descreptionp'] . '</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>';
                        
                        if ($row['stock'] > 0) {
                            echo '<a href="ajouter_panier.php?id=' . $row['idproduct'] . '" class="btn btn-primary">
                                    <i class="fas fa-cart-plus me-1"></i> Ajouter au Panier
                                  </a>';
                        }
                        
                        echo '</div>
                                    </div>
                                </div>
                            </div>';
                    }
                } else {
                    echo '<div class="alert alert-warning text-center">Aucun produit trouvé avec ces critères de recherche.</div>';
                }
            ?>
        </div>
    </div>
    <footer class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 footer-col">
                    <a href="#" class="footer-logo text-white">Sami<span>Express</span></a>
                    <p class="text">Your favorite online store for all your needs. Quality products, fast delivery and exceptional customer service.</p>
                </div>
                <div class="col-lg-2 col-md-6 footer-col footer-links">
                    <h5 class="text-info">Quick Links</h5>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Shop</a></li>

                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-12 text-center text-md-center">
                        <p class="mb-0">&copy; 2023 SamiExpress. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="bootstrap.min.js"></script>
</body>
</html>