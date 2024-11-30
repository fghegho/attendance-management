
<form class="form-horizontal" action="ajoutExcel.php" method="post" name="uploadCSV" enctype="multipart/form-data">

<div>
<label > Choose csv file:</label>
<input type="file" name="file" accept=".csv">
<button type="submit" name ="import">importer</button>

</div>
</form>


<?php

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', 'sam', 'HEM');

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: ". $conn->connect_error);
}

// Fonction pour hacher le mot de passe
function hacherMotDePasse($motDePasse) {
    return password_hash($motDePasse, PASSWORD_DEFAULT);
}

// Chemin du fichier CSV
$cheminFichierCSV = '/Applications/MAMP/htdocs/projet/Classeur3.csv';

// Lire le fichier CSV
if (($fichier = fopen($cheminFichierCSV, "r"))!== false) {
    // Parcourir chaque ligne du fichier
    while (($donnees = fgetcsv($fichier, 1000, ";"))!== false) {
        // Récupérer les données de la ligne
        $nom = $donnees[0];
        $prenom = $donnees[1];
        $etablissement = $donnees[2];
        $filiere = $donnees[3];
        $annee = $donnees[4];
        $classe = $donnees[5];
        $motDePasse = hacherMotDePasse($donnees[6]); // Hacher le mot de passe

        // Préparer la requête SQL d'insertion
        $sql = "INSERT INTO etudiants (nom, prenom, etablissement, filiere, annee, classe, pass_etudiant) VALUES (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);

        // Liaison des paramètres
        $stmt->bind_param("ssssiss", $nom, $prenom, $etablissement, $filiere, $annee, $classe, $motDePasse);

        // Exécution de la requête
        if ($stmt->execute() === true) {
            echo "Enregistrement inséré avec succès : $nom $prenom<br>";
        } else {
            echo "Erreur lors de l'insertion de l'enregistrement : $nom $prenom<br>";
        }
    }
    // Fermer le fichier
    fclose($fichier);
} else {
    echo "Erreur: Impossible d'ouvrir le fichier.";
}

// Fermeture de la connexion
$conn->close();

?>