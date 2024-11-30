<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Prof/Staff</title>
    <style>
        /* Réinitialisation des styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styles de base */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F8F9FA;
            color: #333;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Conteneur principal */
        .container {
            display: flex;
            width: 100%;
        }

        /* Barre latérale */
        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #4C4CFF, #8A2BE2);
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #fff;
        }

        .sidebar a {
            width: 100%;
            text-decoration: none;
            padding: 10px 15px;
            margin: 5px 0;
            color: #fff;
            border-radius: 8px;
            transition: all 0.3s;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .sidebar a:hover {
            background-color: #6B46C1;
            transform: translateX(10px);
        }

        .sidebar a.active {
            background-color: #6B46C1;
            font-weight: bold;
            transform: scale(1.05);
        }

        .sidebar .logout-btn {
            margin-top: auto;
            background: #FF4C4C;
            color: #fff;
            text-align: center;
        }

        .sidebar .logout-btn:hover {
            background: #FF1C1C;
        }

        /* Contenu principal */
        .content {
        
            flex: 1;
            background-color: #FFFFFF;
            border-radius: 15px;
            margin: 20px;
            padding: 20px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            
        }

        /* En-tête */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: #4C4CFF;
            color: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 2rem;
        }

        .header .clock {
            font-size: 1.2rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 15px;
            border-radius: 10px;
        }

        /* Styles pour le formulaire d'ajout */
        .form-container {
            width: 40%;                /* Réduit la largeur du formulaire */
            margin: 50px auto;         /* Centre le formulaire sur la page avec un peu de marge */
            background-color: #fff;
            padding: 15px 20px;        /* Réduit le padding pour une taille plus compacte */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-height: 500px;         /* Limite la hauteur du formulaire */
            overflow-y: auto;          /* Ajoute une barre de défilement verticale si nécessaire */
        }



        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
        }

        .input-group input,
        .input-group select {
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

        /* Pied de page */
        .footer {
            text-align: center;
            font-size: 0.9rem;
            color: #888;
            margin-top: auto;
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image: url('EShem.jpeg');
            background-size: cover;
            background-position: center;
            filter: blur(5px) brightness(0.8);
        }
    </style>
    <link rel="stylesheet" href="style.css"> <!-- Inclure ton fichier CSS si nécessaire -->
</head>
<body>
    <div class="container">
        <!-- Barre latérale (si présente sur mainAdmin) -->
        <div class="sidebar">
            <h2>Menu</h2>
            <a href="mainAdmin.php" class="active">Dashboard</a>
            <a href="inscription.php">Inscription</a>
            <a href="logout.php" class="logout-btn">Déconnexion</a>
        </div>
        
        <!-- Contenu principal -->
        <div class="content">
            <div class="header">
                <h1>Inscription Prof/Staff</h1>
            </div>
            <!-- Formulaire d'inscription -->
            <div class="form-container">
                <form action="inscription.php" method="post">
                    <div class="input-group">
                        <label for="nom">Nom:</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    <div class="input-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" id="prenom" name="prenom" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Mot de passe:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="input-group">
                        <label for="role">Rôle:</label>
                        <select id="role" name="role" required>
                            <option value="professeur">Professeur</option>
                            <option value="staff">Personnel pédagogique</option>
                            <option value="direction">Direction</option>
                        </select>
                    </div>
                    <button type="submit" class="btn">Inscrire</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
// Vérifie si des données ont été soumises via le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli('localhost', 'root', 'sam', 'HEM');

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué: " . $conn->connect_error);
    }

    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Requête SQL pour insérer les données dans la base de données
    $sql = "INSERT INTO Personnel (nom, prenom, email, roole, pass) VALUES ('$nom', '$prenom', '$email', '$role', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "Inscription réussie.";
        header("Location: mainAdmin.php");
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    // Fermeture de la connexion
    $conn->close();
}
?>
