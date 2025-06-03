<?php
session_start();
include 'condb.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous - SamiExpress</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="stylee.css">
    <style>
        .contact-form {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .contact-info {
            background-color: #343a40;
            color: white;
            border-radius: 10px;
            padding: 30px;
            height: 100%;
        }
        .contact-info i {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #0dcaf0;
        }
        .form-control:focus {
            border-color: #0dcaf0;
            box-shadow: 0 0 0 0.25rem rgba(13, 202, 240, 0.25);
        }
        .btn-contact {
            background-color: #0dcaf0;
            border: none;
            padding: 10px 25px;
            font-weight: 600;
        }
        .btn-contact:hover {
            background-color: #0bb6d9;
        }
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
                                <li><a class="dropdown-item" href="#">Mon profil</a></li>
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

<section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-4">
                <h1 class="display-5 fw-bold">Contactez-nous</h1>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="contact-form">
                        <h3 class="mb-4">Envoyez-nous un message</h3>
                        <form action="contact.php" method="POST">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Votre nom</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Votre email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label">Sujet</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-contact" name="submit">Envoyer le message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-5">
                    <div class="contact-info">
                        <h3 class="mb-4">Nos coordonnées</h3>
                        <div class="d-flex mb-5">
                            <i class="fas fa-map-marker-alt me-3 mt-1"></i>
                            <div>
                                <h5>Adresse</h5>
                                <p>123 Avenue Mohammed VI, Casablanca, Maroc</p>
                            </div> 
                        </div>
                        <div class="d-flex mb-5">
                            <i class="fas fa-phone-alt me-3 mt-1"></i>
                            <div>
                                <h5>Téléphone</h5>
                                <p>06 01 44 01 53</p>
                            </div>
                        </div>
                        <div class="d-flex ">
                            <i class="fas fa-envelope me-3 mt-1"></i>
                            <div>
                                <h5>Email</h5>
                                <p>samiftaita@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="afficherproduct.php">Shop</a></li>
                        <li><a href="contact.php">Contact</a></li>
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
<?php

if (isset($_POST['submit'])) {
    $name = ($_POST['name']);
    $email = ($_POST['email']);
    $subject = ($_POST['subject']);
    $message = ($_POST['message']);
    
    $stmt = $pdo->prepare("INSERT INTO commentaire (nom, email, sujet, message) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $subject, $message]);
    
    if ($stmt) {
        echo "<script>alert('Message envoyé avec succès!');</script>";
    } else {
        echo "<script>alert('Erreur lors de l\'envoi du message.');</script>";
    }
}
?>