<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page principale</title>
    <style>
        /* Réinitialisation des marges et des rembourrages */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F8F9FA;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Container Styling */
        .container {
            display: flex;
            width: 100%;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #4C4CFF, #8A2BE2);
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            text-align: center;
            width: 100%;
        }

        .sidebar a {
            width: 100%;
            text-decoration: none;
            padding: 12px 15px;
            margin: 8px 0;
            color: white;
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
            color: white;
            text-align: center;
        }

        .sidebar .logout-btn:hover {
            background: #FF1C1C;
        }

        /* Content Styling */
        .content {
            flex: 1;
            background-color: white;
            margin: 20px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Header Styling */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #4C4CFF;
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .header h1 {
            font-size: 1.8rem;
        }

        .header .clock {
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 15px;
            border-radius: 10px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
        }

        table th {
            background-color: #4C4CFF;
            color: white;
        }

        table td {
            background-color: rgba(240, 240, 240, 0.8);
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        table tr:hover td {
            background-color: #f1f1f1;
        }

        /* Footer Styling */
        .footer {
            text-align: center;
            font-size: 0.9rem;
            color: #666;
            margin-top: auto;
        }

        /* Background Image Styling */
        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image: url('imagemenu.jpeg');
            background-size: cover;
            background-position: center;
            filter: blur(5px) brightness(0.8);
        }

        /* Transition effect */
        body {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Daily HEM</h2>
            <a href="selectclass.php" class="active">Faire l'appel</a>
            <a href="chercherEtudiant.php">Chercher un étudiant</a>
            <a href="index.php" class="logout-btn">Déconnexion</a>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="header">
                <h1>Personnel Page</h1>
                <div class="clock" id="clock"></div>
            </div>

            <!-- Table Data -->
            <table>
                <?php
                session_start(); // Démarre la session

                $conn = new mysqli('localhost', 'root', 'sam', 'HEM');
                    
                    // Vérification de la connexion
                    if ($conn->connect_error) {
                        die("La connexion a échoué: " . $conn->connect_error);
                    }

                // Vérifie si l'email du personnel est défini dans la session
                if(isset($_SESSION['email'])) {
                    // Récupère l'email du personnel à partir de la session
                    $email = $_SESSION['email'];
                    
                    // Connexion à la base de données (à remplacer avec vos propres informations de connexion)
                    $conn = new mysqli('localhost', 'root', 'sam', 'HEM');
                    
                    // Vérification de la connexion
                    if ($conn->connect_error) {
                        die("La connexion a échoué: " . $conn->connect_error);
                    }

                    $sql = "SELECT id_personnel, roole, nom, prenom, email FROM Personnel WHERE email='$email'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Affichage des informations du personnel
                        while($personnel_row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $personnel_row["id_personnel"] . '</td>';
                            echo '<td>' . $personnel_row["roole"] . '</td>';
                            echo '<td>' . $personnel_row["nom"] . '</td>';
                            echo '<td>' . $personnel_row["prenom"] . '</td>';
                            echo '<td>' . $personnel_row["email"] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='5'>Aucun personnel trouvé avec l'email: $email</td></tr>";
                    }

                    // Fermeture de la connexion à la base de données
                    $conn->close();
                } else {
                    echo "<tr><td colspan='5'>Aucune donnée de personnel trouvée dans la session.</td></tr>";
                }
                ?>
            </table>

            <div class="footer">
                © Samy
            </div>
        </div>

        <!-- Background -->
        <div class="background-image"></div>
    </div>

    <script>
        // Fade-in animation
        document.addEventListener("DOMContentLoaded", function () {
            document.body.style.opacity = "1";

            // Horloge dynamique
            const clock = document.getElementById("clock");
            setInterval(() => {
                const now = new Date();
                clock.textContent = now.toLocaleTimeString("fr-FR", {
                    hour: "2-digit",
                    minute: "2-digit",
                    second: "2-digit"
                });
            }, 1000);
        });

        // Déconnexion confirmation
        const logoutBtn = document.querySelector(".logout-btn");
        logoutBtn.addEventListener("click", function (e) {
            const confirmation = confirm("Êtes-vous sûr de vouloir vous déconnecter ?");
            if (!confirmation) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
