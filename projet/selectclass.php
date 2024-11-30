<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu de sélection</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(120deg, #84fab0, #8fd3f4);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            width: 50%;
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        form:hover {
            transform: scale(1.02);
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }

        select {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            transition: border-color 0.3s ease;
        }

        select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        input[type="submit"] {
            background-color: #007bff;
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
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        input[type="submit"]:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <form action="selectclass.php" method="post" onsubmit="return confirmSubmission()">
        <h2>Sélectionnez les critères :</h2>
        
        <label for="etablissement">Etablissement :</label>
        <select name="etablissement" id="etablissement">
            <option value="Casa" selected>Casablanca</option>
            <option value="Rabat">Rabat</option>
            <option value="Tanger">Tanger</option>
            <option value="Marrakech">Marrakech</option>
        </select>

        <label for="filiere">Filière :</label>
        <select name="filiere" id="filiere">
            <option value="ES" selected>ES</option>
            <option value="BS">BS</option>
        </select>

        <label for="annee">Année :</label>
        <select name="annee" id="annee">
            <option value="1" selected>1ère année</option>
            <option value="2">2ème année</option>
            <option value="3">3ème année</option>
            <option value="4">4ème année</option>
            <option value="5">5ème année</option>
        </select>

        <label for="classe">Classe :</label>
        <select name="classe" id="classe">
            <option value="1" selected>Classe 1</option>
            <option value="2">Classe 2</option>
        </select>

        <input type="submit" value="Afficher la classe">
    </form>

    <script>
        // Ajout d'un effet de confirmation avant soumission
        function confirmSubmission() {
            return confirm("Voulez-vous vraiment afficher la classe sélectionnée ?");
        }

        // Animation légère pour le formulaire (parallax au scroll)
        window.addEventListener("scroll", () => {
            const form = document.querySelector("form");
            form.style.transform = `translateY(${window.scrollY * 0.2}px)`;
        });
    </script>

<?php
// Récupération des valeurs sélectionnées dans le formulaire
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
$username = "root";
$password = "sam";
$database = "HEM";

$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

$etablissement = $_POST['etablissement'];
$filiere = $_POST['filiere'];
$annee = $_POST['annee'];
$classe= $_POST['classe'];

    
$sql="SELECT * FROM etudiants WHERE etablissement = '$etablissement' AND filiere='$filiere' AND annee=$annee AND classe=$classe";
$result = $conn->query($sql);





if ($result->num_rows > 0) {
    
    $results_array = array();

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            // Store each row in the results array
            $results_array[] = $row;
        }

    
    // Store the results in session
    $_SESSION['results'] = $results_array;

    $conn->close();

    // Redirect user to another page
    header("Location: affiche.php");
    exit();



}

}

// Utilisez ces valeurs pour interroger votre base de données et afficher la classe correspondante
// Vous devrez écrire le code pour interroger la base de données et afficher la classe ici
?>. 
</body>
</html>
