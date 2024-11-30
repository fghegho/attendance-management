<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Absences</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }
    h2 {
        color: #333;
        font-size: x-large;
    }
    .styled-table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
    }
    .styled-table th, 
    .styled-table td {
        padding: 8px;
        text-align: left;
    }
    .styled-table th {
        background-color: darkblue;
        color: white;
        border-bottom: 1px solid #ddd;
    }
    .styled-table td {
        border-bottom: 1px solid #ddd;
    }
    .styled-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .styled-table tr:hover {
        background-color: #ddd;
    }
    p{
        border-collapse: collapse;
    border-radius: 10px;
    background-color: red;
    color: white;
    font-size: 20px;
    padding: 20px; /* increased padding to 20px */
    width: 300px; /* added width property */
    height: 100px; /* added height property */
    }

    
    
</style>
</head>
<body>

<?php
    // Votre code PHP ici
    

// Assurez-vous que la session est démarrée
session_start();


// Connexion à la base de données
$conn = new mysqli('localhost', 'root', 'sam', 'HEM');

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
} else {
    echo "Connexion réussie.";
}


// Vérifiez si l'id de l'élève est enregistré dans la session
if (!isset($_SESSION['id_etudiant'])) {
    die("Erreur: Aucun étudiant connecté.");
}

$id_etudiant = $_SESSION['id_etudiant'];


// Récupération du nom et prénom de l'élève
$etudiant_query = "SELECT nom, prenom FROM etudiants WHERE id_etudiant = $id_etudiant";
$etudiant_result = $conn->query($etudiant_query);

if ($etudiant_result->num_rows == 1) {
    $etudiant_row = $etudiant_result->fetch_assoc();
    $nom_etudiant = $etudiant_row['nom'];
    $prenom_etudiant = $etudiant_row['prenom'];
} else {
    die("Erreur: Impossible de récupérer les informations de l'étudiant.");
}

// Récupération des données d'absence de l'élève avec le nom de la matière
$absences_query = "SELECT absences.id_absence, absences.id_matiere, absences.total, absences.penalite, matieres.nom_matiere 
                   FROM absences 
                   INNER JOIN matieres ON absences.id_matiere = matieres.id_matiere
                   WHERE absences.id_etudiant = $id_etudiant";
$absences_result = $conn->query($absences_query);

// Affichage des données d'absence sous forme de tableau
echo "<h2>Absences de $prenom_etudiant $nom_etudiant :</h2>";
echo "<table class='styled-table'>";
echo "<tr><th>ID Absence</th><th>Nom Matière</th><th>Total</th><th>Pénalité</th></tr>";

if ($absences_result->num_rows > 0) {
    while ($row = $absences_result->fetch_assoc()) {
        echo "<tr><td>" . $row['id_absence'] . "</td><td>" . $row['nom_matiere'] . "</td><td>" . $row['total'] . "</td>";

        // Vérification de la pénalité
        if ($row['total'] > 6) {
            echo "<td>La note moyenne est de 0</td>";
        } else if ($row['total'] >3) {
            echo "<td>La note de participation est de 0</td>";
        } else {
            echo "<td>" . $row['penalite'] . "</td>";
        }

        echo "</tr>";

        $total_absences += $row['total'];

        

    }


    


} else {
    echo "<tr><td colspan='4'>Aucune absence enregistrée pour cet étudiant.</td></tr>";
}
echo "</table>";

echo "<p1>Nombre total d'absences : $total_absences</p1><br>";

if($total_absences > 72){
    echo "<p2>Redoublement</p2>";
}else if($total_absences >40){
    echo "<p2>Perte des 2 rachats ainsi que la mention</p2>";
}else if($total_absences >20){
    echo "<p2>Perte de 1 rachat</p2>";
}else{
    echo "";
}



 


// Fermeture de la connexion
$conn->close();


?>

 
</body>
</html>









