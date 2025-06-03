<?php
if(isset($_POST['register'])){
    if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo "<script>alert('Please fill in all fields.')</script>";
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stmt = $pdo->prepare("SELECT * FROM compte WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Username already exists. Please choose a different one.')</script>";
        } 
        else {
            $stmt = $pdo->prepare("INSERT INTO compte(username, email, passwordc) VALUES (?, ?, ?)");
            $stmt->execute([$username,$email,$password]);
                echo "<script>alert('Registration successful!')</script>";
                header("Location: index.php"); 
        }
        }
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .register-box {
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .register-title {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
        }
        .form-control {
            height: 45px;
            margin-bottom: 1rem;
        }
        .btn-register {
            height: 45px;
            width: 100%;
            background-color: #3498db;
            border: none;
        }
        .register-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }
        .register-footer a {
            color: #3498db;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-box">
            <h3 class="register-title">Créer un compte</h3>
            
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($success)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-register" name="register">
                    S'inscrire
                </button>
            </form>
            
            <div class="register-footer">
                <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
            </div>
        </div>
    </div>
</body>
</html>