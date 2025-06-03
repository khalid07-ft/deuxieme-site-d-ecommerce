<?php
session_start();
include 'condb.php';
if (isset($_POST['login'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $pdo->prepare("SELECT * FROM compte WHERE username = ? AND passwordc = ?");
        $stmt->execute([$username,$password]);
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
            $_SESSION['user'] = $user;
            echo "<script>alert('Login successful!')</script>";
            header("Location: index.php"); 
            exit();
        } else {
            $error = "Identifiant ou mot de passe incorrect.<br><strong>Ressayer.</strong>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-box {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .login-title {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #2c3e50;
            font-weight: 600;
        }
        .form-control {
            height: 45px;
            margin-bottom: 1rem;
            border-radius: 6px;
            border: 1px solid #ddd;
        }
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        .btn-login {
            height: 45px;
            width: 100%;
            background-color: #3498db;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #7f8c8d;
        }
        .login-footer a {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }
        .custom-alert {
            border-radius: 8px;
            border-left: 4px solid;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .alert-danger {
            background-color: #fde8e8;
            border-left-color: #f44336;
            color: #c0392b;
        }
        .alert-success {
            background-color: #e8f5e9;
            border-left-color: #4caf50;
            color: #27ae60;
        }
        .alert-icon {
            margin-right: 15px;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h3 class="login-title">Connexion</h3>
            
            <?php if (!empty($error)): ?>
                <div class="custom-alert alert-danger animate__animated animate__fadeIn">
                    <i class="fas fa-exclamation-circle alert-icon"></i>
                    <div>
                        <strong>Erreur !</strong> <?php echo $error; ?>
                    </div>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-login" name="login">
                    <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                </button>
            </form>
            
            <div class="login-footer">
                <p>Pas de compte ? <a href="register.php">S'inscrire</a></p>
            </div>
        </div>
    </div>

    <script src="bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>