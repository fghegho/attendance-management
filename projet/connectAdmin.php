<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .container {
            width: 50%;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="connectAdmin.php" method="post">
            <h2>Connexion des Administrateur</h2>
            
            <div class="input-group">
                <label for="id">identifiant:</label>
                <input type="number" id="id" name="id" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="passw" required>
            </div>
            <button type="submit" class="btn">Se connecter</button>
        </form>
    </div>
</body>
</html>


<?php

// Connexion à la base de données (à remplacer avec vos propres informations de connexion)
$servername = "localhost";
$username = "root";
$password = "sam";
$database = "HEM";

$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données saisies par l'utilisateur depuis le formulaire
    $id = $_POST['id'];
    $pass = $_POST['passw'];

    // Requête pour récupérer l'enregistrement correspondant à l'identifiant fourni
    $sql = "SELECT * FROM administrateur WHERE id_admin = '$id'";
    $result = $conn->query($sql);

    // Vérifier si un enregistrement avec cet identifiant existe
    if ($result->num_rows > 0) {
        // Récupérer les données de l'enregistrement
        $row = $result->fetch_assoc();
        // Vérifier si le mot de passe correspond
        if (password_verify($pass, $row['passw'])) {
            // Les identifiants sont corrects, connectez l'utilisateur
            
            header("Location: mainAdmin.php"); // Redirige vers la page principale de l'étudiant
            exit;
        } else {
            // Mot de passe incorrect
            echo "Mot de passe incorrect.";
        }
    } else {
        // Aucun enregistrement avec cet identifiant trouvé
        echo "Aucun utilisateur trouvé avec cet id.";
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
