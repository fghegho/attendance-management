<?php
if (isset($_POST['send'])) {
    $to = "alidara@gmail.com";
    $subject = "Absences pour le cours de $nom_matiere";
    $message = $table;
    $headers = "From: votre_email@example.com". "\r\n".
    "CC: autre_email@example.com";

    mail($to, $subject, $message, $headers);

    echo "Email envoyé avec succès.";
}
?>