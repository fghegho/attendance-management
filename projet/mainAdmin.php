<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page principale Administrateur</title>
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

        /* Image de fond */
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

            <div class="background-image"></div>

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

        // Déconnexion confirmation
        const logoutBtn = document.querySelector(".logout-btn");
        logoutBtn.addEventListener("click", function(e) {
            const confirmation = confirm("Êtes-vous sûr de vouloir vous déconnecter ?");
            if (!confirmation) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>