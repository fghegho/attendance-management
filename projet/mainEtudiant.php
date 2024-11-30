<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page principale</title>
    <style>
        /* Réinitialisation des marges et styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
        }

        /* Container */
        .container {
    display: flex;
    width: 90%;
    max-width: 1200px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    overflow: hidden;
    min-height: 80vh; /* Nouvelle hauteur minimale */
}

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            padding: 30px 20px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h2 {
            margin-bottom: 20px;
            font-size: 20px;
            text-align: center;
            text-transform: uppercase;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            margin-bottom: 10px;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.1);
            transition: background 0.3s;
        }

        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.3);
            font-weight: bold;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .logout-btn {
            margin-top: 30px;
            padding: 12px;
            text-align: center;
            background: #ff5f57;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .logout-btn:hover {
            background: #ff3838;
        }

        /* Content Styling */
        .content {
    flex: 1;
    padding: 40px;
    background-color: white;
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Pour bien distribuer le contenu */
    min-height: 70vh; /* Nouvelle hauteur minimale */
}

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #2575fc;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #f9f9f9;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background: #2575fc;
            color: white;
            text-transform: uppercase;
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f1f5ff;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .modal-content button {
            margin: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .confirm {
            background: #4caf50;
            color: white;
        }

        .cancel {
            background: #f44336;
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                text-align: center;
            }

            .content {
                padding: 20px;
            }

            table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Menu</h2>
            <a href="voirAbsences.php" class="menu-link">Voir mes absences</a>
            <button class="logout-btn">Déconnexion</button>
        </div>
        <div class="content">
            <div class="header">
                <h1>Daily HEM Étudiants</h1>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Établissement</th>
                        <th>Filière</th>
                        <th>Année</th>
                        <th>Classe</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        session_start(); // Démarre la session

                        // Vérifiez si l'identifiant de l'étudiant est défini dans la session
                        if(isset($_SESSION['id_etudiant'])) {
                            // Récupérez l'identifiant de l'étudiant à partir de la session
                            $id_etudiant = $_SESSION['id_etudiant'];
                        
                            // Connexion à la base de données (à remplacer avec vos propres informations de connexion)
                            $conn = new mysqli('localhost', 'root', 'sam', 'HEM');
                        
                            // Vérification de la connexion
                            if ($conn->connect_error) {
                                die("La connexion a échoué: " . $conn->connect_error);
                            }
                        

                            $sql = "SELECT id_etudiant, nom, prenom, etablissement, filiere, annee, classe FROM etudiants WHERE id_etudiant=$id_etudiant";
                            $result = $conn->query($sql);


                            if ($result->num_rows > 0) {
                                // Affichage des informations de l'étudiant
                               
                               

                                while($student_row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . $student_row["id_etudiant"] . '</td>';
                                    echo '<td>' . $student_row["nom"] . '</td>';
                                    echo '<td>' . $student_row["prenom"] . '</td>';
                                    echo '<td>' . $student_row["etablissement"] . '</td>';
                                    echo '<td>' . $student_row["filiere"] . '</td>';
                                    echo '<td>' . $student_row["annee"] . '</td>';
                                    echo '<td>' . $student_row["classe"] . '</td>';
                                    echo '</tr>';
                                }

                               
                            } else {
                                echo "Aucun étudiant trouvé avec l'ID: $id_etudiant";
                            }

                            // Fermeture de la connexion à la base de données
                            $conn->close();
                        } else {
                            echo "Aucune donnée d'étudiant trouvée dans la session.";
                        }
                        ?>

                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="logout-modal">
        <div class="modal-content">
            <p>Êtes-vous sûr de vouloir vous déconnecter ?</p>
            <button class="confirm" id="confirm-logout">Oui</button>
            <button class="cancel" id="cancel-logout">Non</button>
        </div>
    </div>

    <script>
        // Highlight active link
        const links = document.querySelectorAll('.menu-link');
        links.forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('active');
            }
        });

        // Logout confirmation
        const logoutBtn = document.querySelector('.logout-btn');
        const modal = document.getElementById('logout-modal');
        const confirmLogout = document.getElementById('confirm-logout');
        const cancelLogout = document.getElementById('cancel-logout');

        logoutBtn.addEventListener('click', () => {
            modal.style.display = 'flex';
        });

        cancelLogout.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        confirmLogout.addEventListener('click', () => {
            window.location.href = 'index.php';
        });
    </script>
</body>
</html>
