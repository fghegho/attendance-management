



<DOCTYPE html>
<html>
    <body>
        <form class="container" action="afficherAbsence.php" method="post">

        <div class="btn"><button type="submit" name="send">Send</button></div>
        </form>

        <div class="btn2" ><a href="mainmain.php"> <button>Retour a la page d'accueil</button></a></div>
</body>
</html>
    
    <style>

.btn button {
    background-color: darkblue;
    border: none;
    border-radius: 40px; /* Augmentation du rayon de bordure */
    color: white;
    padding: 25px 40px; /* Ajustez les valeurs pour définir la taille */
    font-size: 24px; /* Augmentation de la taille de la police */
    position: fixed;
    top: 20px; /* Position en haut */
    right: 20px; /* Position à droite */
    cursor: pointer;
    z-index: 999; /* Pour s'assurer que le bouton est au-dessus du contenu */
}


.btn2 button {
    background-color: darkblue;
    border: none;
    border-radius: 30px;
    color: white;
    padding: 15px 30px; /* Ajustez les valeurs pour définir la taille */
    font-size: 18px;
    position: fixed;
    bottom: 20px; /* Position en haut */
    right: 20px; /* Position à droite */
    cursor: pointer;
    z-index: 999; /* Pour s'assurer que le bouton est au-dessus du contenu */
}
button:hover {
    background-color: #45a049;
}

    .styled-table {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .styled-table th {
        background-color: darkblue;
        color: #ffffff;
        font-weight: bold;
    }

    .styled-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .styled-table tr:hover {
        background-color: #ddd;
    }
</style>

</body>
</html>






<?php

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', 'sam', 'HEM');

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
} else {
    echo "Connexion réussieeeee.";
}

// Récupération des données passées via l'URL
$matiere = $_GET['matiere'];
$absents = explode(',', $_GET['absents']);

// Affichage des données sélectionnées
echo "<h2>Absent pour le cours de :</h2>";

$matiere_query = "SELECT nom_matiere FROM matieres WHERE id_matiere = $matiere";
$matiere_result = $conn->query($matiere_query);

if ($matiere_result->num_rows > 0) {
    $row = $matiere_result->fetch_assoc();
    $nom_matiere = $row['nom_matiere'];
    echo "<h3>$nom_matiere</h3>";
} else {
    echo "<p>Erreur: Matière introuvable</p>";
}




echo "<table class='styled-table'>";
echo "<tr><th>Nom</th><th>Prénom</th><th>classe</th><th>filiere</th></tr>";

foreach ($absents as $etudiant) {
    $student_query = "SELECT etudiants.nom, etudiants.prenom, etudiants.classe, etudiants.filiere, matieres.nom_matiere 
                        FROM absences 
                        INNER JOIN etudiants ON absences.id_etudiant = etudiants.id_etudiant 
                        INNER JOIN matieres ON absences.id_matiere = matieres.id_matiere 
                        WHERE absences.id_etudiant = $etudiant AND absences.id_matiere = $matiere";
    $student_result = $conn->query($student_query);

    

    if ($student_result->num_rows > 0) {
        while ($row = $student_result->fetch_assoc()) {
            echo "<tr><td>" . $row['nom'] . "</td><td>" . $row['prenom'] . "</td><td>" . $row['classe'] . "</td><td>" . $row['filiere'] . "</td></tr>" ;
        }
    } else {
        echo "<li>Aucune donnée trouvée pour l'étudiant $etudiant</li>";
    }
}
echo "</table>";

// Fermeture de la connexion
$conn->close();



if (isset($_POST['send'])) {
    $to = "alidara493@gmail.com";
    $subject = "Absences pour le cours de $nom_matiere";
    $message = $table;
    $headers = "From: comptereceveur23@gmail.com". "\r\n".
    "CC: autre_email@example.com";

    mail($to, $subject, $message, $headers);

    echo "Email envoyé avec succès.";
}
?>








