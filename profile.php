<?php
session_start();
include 'condb.php';
$stmt = $pdo->prepare("SELECT * FROM compte WHERE id = ?");
$stmt->execute([$_SESSION['user']['id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $pdo->prepare("SELECT COUNT(idc) as nbcommande FROM commande WHERE iduser = ?");
$stmt->execute([$_SESSION['user']['id']]);
$nbcommande = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --light-gray: #ecf0f1;
            --text-color: #34495e;
        }
        
        body {
            font-family: 'Roboto', 'Helvetica Neue', Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .profile-container:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        
        .profile-header {
            background: var(--primary-color);
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .profile-header h2 {
            margin: 0;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        .profile-content {
            padding: 30px;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--light-gray);
            align-items: center;
        }
        
        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .info-label {
            font-weight: 500;
            width: 160px;
            color: var(--primary-color);
        }
        
        .info-value {
            flex: 1;
            word-break: break-word;
        }
        
        .commandes-badge {
            display: inline-block;
            background: var(--secondary-color);
            color: white;
            padding: 6px 12px;
            border-radius: 16px;
            font-weight: 500;
            font-size: 0.9em;
            min-width: 30px;
            text-align: center;
        }
        
        @media (max-width: 640px) {
            .info-row {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .info-label {
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <h2>Mon Profil</h2>
        </div>
        
        <div class="profile-content">
            <div class="info-row">
                <div class="info-label">Nom d'utilisateur</div>
                <div class="info-value"><?= htmlspecialchars($user['username']) ?></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Adresse email</div>
                <div class="info-value"><?= htmlspecialchars($user['email']) ?></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Commandes passées</div>
                <div class="info-value">
                    <span class="commandes-badge"><?= $nbcommande['nbcommande'] ?></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>