<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sélectionner une Matière</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }
    h2 {
        color: #333;
    }
    .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    form {
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    select {
        width: 100%;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    input[type="submit"] {
        background-color: #1c2a61;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
    .absence-table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
    }
    .absence-table th, 
    .absence-table td {
        padding: 8px;
        text-align: left;
    }
    .absence-table th {
        background-color: #f2f2f2;
        border-bottom: 2px solid #ddd;
    }
    .absence-table td {
        border-bottom: 1px solid #ddd;
    }
    .absence-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Sélectionner une Matière</h2>
    <form method="post">
        <label for="matiere">Sélectionnez une Matière :</label>
        <select name="matiere" id="matiere">
            <?php
            // Connexion à la base de données
            $conn = new mysqli('localhost', 'root', 'sam', 'HEM');

            // Vérification de la connexion
            if ($conn->connect_error) {
                die("La connexion a échoué: " . $conn->connect_error);
            }

            // Récupération des matières depuis la base de données
            $matieres_query = "SELECT id_matiere, nom_matiere FROM matieres";
            $matieres_result = $conn->query($matieres_query);

            // Affichage des options de sélection
            if ($matieres_result->num_rows > 0) {
                while ($row = $matieres_result->fetch_assoc()) {
                    echo "<option value='" . $row['id_matiere'] . "'>" . $row['nom_matiere'] . "</option>";
                }
            }

            // Fermeture de la connexion
            $conn->close();
            ?>
        </select>
        <input type="submit" value="Afficher les Absences">
    </form>

    <?php
    // Traitement des absences sélectionnées
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selected_matiere = $_POST['matiere'];

        // Connexion à la base de données
        $conn = new mysqli('localhost', 'root', 'sam', 'HEM');

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("La connexion a échoué: " . $conn->connect_error);
        }

        // Récupération des absences pour la matière sélectionnée
        $absences_query = "SELECT * FROM absences WHERE id_matiere = $selected_matiere";
        $absences_result = $conn->query($absences_query);

        if ($absences_result->num_rows > 0) {
            echo "<h2>Absences pour la Matière sélectionnée :</h2>";
            echo "<table class='absence-table'>";
            echo "<tr><th>ID Absence</th><th>ID Étudiant</th><th>Total</th></tr>";

            $total_absences = 0;
            $total_rows = $absences_result->num_rows;

            while ($row = $absences_result->fetch_assoc()) {
                echo "<tr><td>" . $row['id_absence'] . "</td><td>" . $row['id_etudiant'] . "</td><td>" . $row['total'] . "</td></tr>";
                $total_absences += $row['total'];
            }

            echo "</table>";

             

            // Calcul du nombre moyen d'absences
            $average_absences = $total_absences / $total_rows;
            echo "<p>Nombre total d'absences dans cette matière : $total_absences</p>";
            echo "<p>Nombre moyen d'absences par élève : " . number_format($average_absences, 2) . "</p>";
        } else {
            echo "<p>Aucune absence enregistrée pour cette matière.</p>";
        }

        // Fermeture de la connexion
        $conn->close();
    }
    ?>

</div>

</body>
</html>
