<?php

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', 'sam', 'HEM');

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
} else {
    echo "Connexion réussie.";
}

// Récupération des données du formulaire
$matiere = $_POST['matiere'];
$absents = $_POST['absent'];

// Date d'absence (peut être la date actuelle)

// Insertion des données dans la table d'absences
foreach ($absents as $etudiant) {
    // Vérifier si une absence pour cet étudiant et cette matière existe déjà
    $check_query = "SELECT * FROM absences WHERE id_etudiant = ? AND id_matiere = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $etudiant, $matiere);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Une absence existe déjà, mettre à jour le total
        $update_query = "UPDATE absences SET total = total + 1 WHERE id_etudiant = ? AND id_matiere = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ii", $etudiant, $matiere);
        if ($stmt->execute() === FALSE) {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // Aucune absence existante, insérer une nouvelle absence
        $insert_query = "INSERT INTO absences (id_etudiant, id_matiere, total) VALUES (?, ?, 1)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ii", $etudiant, $matiere);
        if ($stmt->execute() === FALSE) {
            echo "Error inserting record: " . $conn->error;
        }
    }
}

// Fermeture de la connexion
$conn->close();

// Redirection vers la page précédente
// Redirection vers la page afficherAbsence.php avec les données sélectionnées
header("Location: afficherAbsence.php?matiere=$matiere&absents=" . implode(',', $absents));
?>
