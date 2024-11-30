<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(120deg, #8e44ad, #3498db);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 900px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 8px;
        }

        select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px;
        }

        th {
            background-color: #6c5ce7;
            color: #fff;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        input[type="checkbox"] {
            transform: scale(1.5);
        }

        input[type="submit"] {
            background-color: #27ae60;
            color: #fff;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
            display: block;
            margin: 0 auto;
        }

        input[type="submit"]:hover {
            background-color: #2ecc71;
            transform: translateY(-2px);
        }

        input[type="submit"]:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <form method="post" action="insert.php">
        <h1>Résultats</h1>

        <label for="matiere">Matière :</label>
        <select name="matiere" id="matiere">
            <!-- Choix des matières d'ingénierie informatique -->
            <optgroup label="Ingénierie Informatique">
                <option value="1">Algorithmique avancée</option>
                <option value="2">Architecture des ordinateurs</option>
                <option value="3">Bases de données</option>
                <option value="4">Systèmes d'exploitation</option>
                <option value="5">Réseaux informatiques</option>
                <option value="6">Intelligence artificielle</option>
                <option value="7">Développement web</option>
                <option value="8">Sécurité informatique</option>
            </optgroup>
            
            <!-- Choix des matières de business -->
            <optgroup label="Business">
                <option value="9">Marketing</option>
                <option value="10">Gestion financière</option>
                <option value="11">Stratégie d'entreprise</option>
                <option value="12">Ressources humaines</option>
                <option value="13">Analyse financière</option>
                <option value="14">Management des opérations</option>
                <option value="15">Entrepreneuriat</option>
                <option value="16">Éthique des affaires</option>
            </optgroup>
        </select>

        <?php
        session_start();

        // Check if results are stored in session
        if (isset($_SESSION['results'])) {
            $results = $_SESSION['results'];

            // Output results as a table
            echo "<table>";
            echo "<tr><th>Nom et Prénom</th><th>Absent</th></tr>"; // Table header

            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["nom"]) . " " . htmlspecialchars($row["prenom"]) . "</td>";
                echo "<td><input type='checkbox' name='absent[]' value='" . htmlspecialchars($row["id_etudiant"]) . "'></td>";
                echo "</tr>";
            }

            echo "</table>";

            // Clear session data
            unset($_SESSION['results']);
        } else {
            echo "<p>Aucun résultat trouvé.</p>";
        }
        ?>

        <input type="submit" value="Soumettre">
    </form>
</body>
</html>
