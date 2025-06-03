<?php
session_start();
include 'condb.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SamiExpress - Votre boutique en ligne</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="stylee.css">
    <style>
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm p-3">
        <div class="container">
            <h3><a class="navbar-brand text-primary" href="index.php">Sami<span class="text-white">Express</span></a></h3>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mx-auto">
        <li class="nav-item">
            <a class="nav-link active" href="index.php">
                <i class="fas fa-home me-1"></i> Home
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="shopDropdown" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-shopping-bag me-1"></i> Shop
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="afficherproduct.php">All Products</a></li>
                <li><a class="dropdown-item" href="product.php">Insert Product</a></li>
                <li><a class="dropdown-item" href="categorie.php">Insert Category</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#about">
                <i class="fas fa-info-circle me-1"></i> About
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="contact.php">
                <i class="fas fa-envelope me-1"></i> Contact
            </a>
        </li>
    </ul>
</div>
                <div class="d-flex">
       
                    <div class="dropdown ms-5">
    <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
        <i class="fas fa-user me-1"></i> 
        <?php 
        if(isset($_SESSION['user'])) {
            echo ($_SESSION['user']['username']); 
        } else {
            echo "Account";
        }
        ?>
    </a>
    <ul class="dropdown-menu">
        <?php if(isset($_SESSION['user'])): ?>
            <li><span class="dropdown-item text-muted"><span class="text-primary">USERNAME</span><br> <strong><?= $_SESSION['user']['username'] ?></strong></span></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="profile.php">Mon profil</a></li>
            <li><a class="dropdown-item" href="logout.php">Déconnexion</a></li>
        <?php else: ?>
            <li><a class="dropdown-item" href="login.php">Connexion</a></li>
            <li><a class="dropdown-item" href="register.php">Inscription</a></li>
        <?php endif; ?>
    </ul>
</div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-3" id="hero">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="hero-title">SamiExpress – Your online shopping experience, faster, easier, and more exciting than ever before!</h1>
                    <p class="hero-text">Elevate your style with our exclusive collection. Handcrafted with premium materials and designed for comfort that lasts.</p>
                    <div class="d-flex flex-wrap hero-btns">
                        <a href="afficherproduct.php" class="btn btn-dark hero-btn">
                            Shop Now <i class="fas fa-cart-shopping ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image text-center" ></div>
            </div>
        </div>
    </div>

    <section class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Shop by Categories</h2>
            <a href="afficherproduct.php" class="btn btn-dark">View All Categories <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="category-card card border-0 rounded-3 overflow-hidden shadow-sm">
                    <div class="position-relative">
                        <img src="images/elect.jpeg" 
                             class="card-img-top" 
                             alt="Electronics"
                             style="height: 180px; object-fit: cover;">
                        <div class="category-overlay"></div>
                    </div>
                    <div class="card-body text-center p-3">
                        <h5 class="card-title fw-bold mb-1">Electronics</h5>
                        <p class="text-muted small mb-2">150+ Products</p>
                        <a href="afficherproduct.php?idcategorie=1" class="btn btn-sm btn-outline-primary stretched-link">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="category-card card border-0 rounded-3 overflow-hidden shadow-sm">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                             class="card-img-top" 
                             alt="Fashion"
                             style="height: 180px; object-fit: cover;">
                        <div class="category-overlay"></div>
                    </div>
                    <div class="card-body text-center p-3">
                        <h5 class="card-title fw-bold mb-1">Fashion</h5>
                        <p class="text-muted small mb-2">320+ Products</p>
                        <a href="afficherproduct.php?idcategorie=2" class="btn btn-sm btn-outline-primary stretched-link">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="category-card card border-0 rounded-3 overflow-hidden shadow-sm">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                             class="card-img-top" 
                             alt="Home & Garden"
                             style="height: 180px; object-fit: cover;">
                        <div class="category-overlay"></div>
                    </div>
                    <div class="card-body text-center p-3">
                        <h5 class="card-title fw-bold mb-1">Home & Garden</h5>
                        <p class="text-muted small mb-2">210+ Products</p>
                        <a href="afficherproduct.php?idcategorie=4" class="btn btn-sm btn-outline-primary stretched-link">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="category-card card border-0 rounded-3 overflow-hidden shadow-sm">
                    <div class="position-relative">
                        <img src="images/beau.jpeg" 
                             class="card-img-top" 
                             alt="Beauty & Health"
                             style="height: 180px; object-fit: cover;">
                        <div class="category-overlay"></div>
                    </div>
                    <div class="card-body text-center p-3">
                        <h5 class="card-title fw-bold mb-1">Beauty & Health</h5>
                        <p class="text-muted small mb-2">95+ Products</p>
                        <a href="afficherproduct.php?idcategorie=8" class="btn btn-sm btn-outline-primary stretched-link">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="category-card card border-0 rounded-3 overflow-hidden shadow-sm">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                             class="card-img-top" 
                             alt="Sports & Outdoors"
                             style="height: 180px; object-fit: cover;">
                        <div class="category-overlay"></div>
                    </div>
                    <div class="card-body text-center p-3">
                        <h5 class="card-title fw-bold mb-1">Sports & Outdoors</h5>
                        <p class="text-muted small mb-2">120+ Products</p>
                        <a href="afficherproduct.php?idcategorie=5" class="btn btn-sm btn-outline-primary stretched-link">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="category-card card border-0 rounded-3 overflow-hidden shadow-sm">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1596461404969-9ae70f2830c1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                             class="card-img-top" 
                             alt="Toys & Games"
                             style="height: 180px; object-fit: cover;">
                        <div class="category-overlay"></div>
                    </div>
                    <div class="card-body text-center p-3">
                        <h5 class="card-title fw-bold mb-1">Toys & Games</h5>
                        <p class="text-muted small mb-2">80+ Products</p>
                        <a href="afficherproduct.php?idcategorie=7" class="btn btn-sm btn-outline-primary stretched-link">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="category-card card border-0 rounded-3 overflow-hidden shadow-sm">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1550583724-b2692b85b150?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                             class="card-img-top" 
                             alt="Groceries"
                             style="height: 180px; object-fit: cover;">
                        <div class="category-overlay"></div>
                    </div>
                    <div class="card-body text-center p-3">
                        <h5 class="card-title fw-bold mb-1">Groceries</h5>
                        <p class="text-muted small mb-2">250+ Products</p>
                        <a href="afficherproduct.php?idcategorie=9" class="btn btn-sm btn-outline-primary stretched-link">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="category-card card border-0 rounded-3 overflow-hidden shadow-sm">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                             class="card-img-top" 
                             alt="Books"
                             style="height: 180px; object-fit: cover;">
                        <div class="category-overlay"></div>
                    </div>
                    <div class="card-body text-center p-3">
                        <h5 class="card-title fw-bold mb-1">Books</h5>
                        <p class="text-muted small mb-2">180+ Products</p>
                        <a href="afficherproduct.php?idcategorie=6" class="btn btn-sm btn-outline-primary stretched-link">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container mb-5 mt-5" id="about">
        <h1 class="text-center mb-5"  >About Us</h1>
        <div class="row g-4 mt-4 mb-5">
            <div class="col-md-3">
                <div class="feature-box">
                    <div class="feature-icon m-2">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h5>Free Shipping</h5>
                    <p class="mb-0">On orders over 50 MAD</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-box">
                    <div class="feature-icon m-2">
                        <i class="fas fa-undo"></i>
                    </div>
                    <h5>Easy Returns</h5>
                    <p class="mb-0">30-day return policy</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-box">
                    <div class="feature-icon m-2">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h5>Secure Payment</h5>
                    <p class="mb-0">100% secure checkout</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-box">
                    <div class="feature-icon m-2">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h5>24/7 Support</h5>
                    <p class="mb-0">Dedicated support</p>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-dark text-white mt-5">
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
                        <li><a href="afficherproduct.php">Shop</a></li>
                    
                    </ul>
        </div>
            </div>
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-12 text-center text-md-center ">
                        <p class="mb-0">&copy; 2023 SamiExpress. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="bootstrap.min.js"></script>
</body>
</html>