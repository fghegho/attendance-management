<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absences</title>
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

        /* Effets de transition */
        body {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        /* Pied de page */
        .footer {
            text-align: center;
            font-size: 0.9rem;
            color: #888;
            margin-top: auto;
        }

        /* Tableau d'absences */
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px;
            text-align: left;
        }

        .styled-table th {
            background-color: #f2f2f2;
            border-bottom: 2px solid #ddd;
        }

        .styled-table td {
            border-bottom: 1px solid #ddd;
        }

        .styled-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .styled-table tr:hover {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
            margin-top: 20px;
        }

        .outcome {
            margin-top: 10px;
            color: #333;
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
            <a href="mainAdmin.php" class="active">Dashboard</a>
            <a href="searchStudent.php">Rechercher étudiant</a>
            <a href="absences.php">Absences</a>
            <a href="logout.php" class="logout-btn">Déconnexion</a>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="header">
                <h1>Absences Étudiant</h1>
                <div class="clock" id="clock"></div>
            </div>

            <div class="background-image"></div>

            <div class="content-body">
                <?php
                // Connexion à la base de données
                $conn = new mysqli('localhost', 'root', 'sam', 'HEM');
                if ($conn->connect_error) {
                    die("La connexion a échoué: " . $conn->connect_error);
                }

                $id_etudiant = "";

                // Vérification du formulaire
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $id_etudiant = $_POST['id_etudiant'];
                }

                if ($id_etudiant == "") {
                ?>
                    <form method="post">
                        <h2>Entrez l'ID de l'étudiant :</h2>
                        <input type="text" name="id_etudiant" placeholder="ID Étudiant" required>
                        <input type="submit" value="Valider">
                    </form>
                <?php
                } else {
                    // Récupérer les informations de l'étudiant
                    $etudiant_query = "SELECT nom, prenom FROM etudiants WHERE id_etudiant = $id_etudiant";
                    $etudiant_result = $conn->query($etudiant_query);
                    if ($etudiant_result->num_rows == 1) {
                        $etudiant_row = $etudiant_result->fetch_assoc();
                        $nom_etudiant = $etudiant_row['nom'];
                        $prenom_etudiant = $etudiant_row['prenom'];
                    } else {
                        die("Erreur: Impossible de récupérer les informations de l'étudiant.");
                    }

                    // Récupérer les absences de l'étudiant
                    $absences_query = "SELECT absences.id_absence, absences.id_matiere, absences.total, absences.penalite, matieres.nom_matiere 
                                       FROM absences 
                                       INNER JOIN matieres ON absences.id_matiere = matieres.id_matiere
                                       WHERE absences.id_etudiant = $id_etudiant";
                    $absences_result = $conn->query($absences_query);

                    echo "<h2>Absences de $prenom_etudiant $nom_etudiant :</h2>";
                    echo "<table class='styled-table'>
                            <tr><th>ID Absence</th><th>Nom Matière</th><th>Total</th><th>Pénalité</th></tr>";

                    if ($absences_result->num_rows > 0) {
                        $total_absences = 0;
                        while ($row = $absences_result->fetch_assoc()) {
                            echo "<tr><td>" . $row['id_absence'] . "</td><td>" . $row['nom_matiere'] . "</td><td>" . $row['total'] . "</td>";
                            if ($row['total'] > 6) {
                                echo "<td>La note moyenne est de 0</td>";
                            } else if ($row['total'] > 3) {
                                echo "<td>La note de participation est de 0</td>";
                            } else {
                                echo "<td>" . $row['penalite'] . "</td>";
                            }
                            echo "</tr>";
                            $total_absences += $row['total'];
                        }
                        echo "</table>";
                        echo "<p class='total'>Nombre total d'absences : $total_absences</p>";
                    } else {
                        echo "<p>Aucune absence trouvée pour cet étudiant.</p>";
                    }
                }

                $conn->close();
                ?>
            </div>

            <div class="footer">
                © 2024 Daily HEM. Tous droits réservés.
            </div>
        </div>
    </div>

    <script>
        // Transition d'apparition
        document.addEventListener("DOMContentLoaded", function() {
            document.body.style.opacity = "1";

            // Horloge dynamique
            const clock = document.getElementById("clock");
            setInterval(() => {
                const now = new Date();
                clock.textContent = now.toLocaleTimeString("fr-FR", { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            }, 1000);
        });
    </script>
</body>
</html>
