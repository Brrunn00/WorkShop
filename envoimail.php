<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destinataire = $_POST['email'];
    $sujet = "Exemple d'e-mail envoyé depuis GESTSTOCK";
    $message = "Bonjour,\n\nCeci est un exemple d'e-mail envoyé depuis GESTSTOCK.";

    // En-têtes de l'e-mail
    $headers = "From: Votre nom <votre_email@example.com>\r\n";
    $headers .= "Reply-To: votre_email@example.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Envoi de l'e-mail
    if (mail($destinataire, $sujet, $message, $headers)) {
        header("Location: verification.php");
        exit;
    } else {
        echo "Une erreur est survenue lors de l'envoi de l'e-mail.";
    }
}
?>
