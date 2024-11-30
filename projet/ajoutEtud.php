<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un étudiant</title>
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
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Admin Panel</h2>
            <a href="ajoutEtud.php" class="active">Ajouter un étudiant</a>
            <a href="inscription.php">Ajouter un professeur</a>
            <a href="chercherEtudiant.php">Chercher un étudiant</a>
            <a href="ajoutExcel.php">Importer via CSV</a>
            <a href="absenceMatiere.php">Absenteisme par matière</a>
            <a href="index.php" class="logout-btn">Déconnexion</a>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="header">
                <h1>Daily HEM Administrateur</h1>
                <div class="clock" id="clock"></div>
            </div>

            <!-- Formulaire d'ajout d'étudiant -->
            <div class="form-container">
                <form action="ajoutEtud.php" method="post">
                    <h2>Ajouter un étudiant</h2>
                    <div class="input-group">
                        <label for="nom">Nom:</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    <div class="input-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" id="prenom" name="prenom" required>
                    </div>
                    <div class="input-group">
                        <label for="etablissement">Établissement:</label>
                        <select id="etablissement" name="etablissement" required>
                            <option value="Casa">Casa</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Marrakech">Marrakech</option>
                            <option value="Tanger">Tanger</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="filiere">Filière:</label>
                        <select id="filiere" name="filiere" required>
                            <option value="ES">ES</option>
                            <option value="BS">BS</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="annee">Année:</label>
                        <select id="annee" name="annee" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="classe">Classe:</label>
                        <input type="text" id="classe" name="classe" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Mot de passe:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn">Ajouter</button>
                </form>
            </div>

            <div class="footer">
                © 2024 Daily HEM. Tous droits réservés.
            </div>
        </div>
    </div>

    <script>
        // Horloge dynamique
        const clock = document.getElementById("clock");
        setInterval(() => {
            const now = new Date();
            clock.textContent = now.toLocaleTimeString("fr-FR", { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        }, 1000);
    </script>
</body>
</html>

<?php
$conn = new mysqli('localhost', 'root', 'sam', 'HEM');

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $etablissement = $_POST['etablissement'];
    $filiere = $_POST['filiere'];
    $annee = $_POST['annee'] ;
    $classe = $_POST['classe'] ;
    $passw = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Requête SQL pour insérer les données dans la base de données
    $sql = "INSERT INTO etudiants (nom, prenom, etablissement, filiere, annee, classe, pass_etudiant) VALUES ('$nom', '$prenom', '$etablissement', '$filiere', '$annee', '$classe', '$passw')";

    if ($conn->query($sql) === TRUE) {
        echo "Étudiant ajouté avec succès.";
        header("Location: mainAdmin.php");
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    // Fermeture de la connexion
    $conn->close();
}
?>
