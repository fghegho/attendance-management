<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <style>
        /* Style global */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #eef2f3, #8e9eab);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Conteneur principal */
        .container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 40px 30px;
            text-align: center;
            width: 100%;
            max-width: 500px;
            animation: fadeIn 1s ease-out;
        }

        /* Logo */
        .container img {
            width: 400px;
            height: auto;
            margin-bottom: 20px;
        }

        /* Titre principal */
        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Boutons */
        .btn {
            display: block;
            width: 100%;
            max-width: 300px;
            margin: 10px auto;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: 500;
            color: #fff;
            background: linear-gradient(135deg, #4a90e2, #007aff);
            border: none;
            border-radius: 25px;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, #007aff, #4a90e2);
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 30px 20px;
            }

            h1 {
                font-size: 24px;
            }

            .btn {
                font-size: 16px;
                padding: 12px 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="photohem.png" alt="Logo Daily HEM">
        <h1>Bienvenue sur Daily HEM</h1>
        <a href="connect.php" class="btn">Espace Professeur</a>
        <a href="connectEtudiant.php" class="btn">Espace Étudiant</a>
        <a href="connectAdmin.php" class="btn">Espace Administrateur</a>
    </div>
</body>
</html>
