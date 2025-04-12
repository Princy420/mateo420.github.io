<?php
// Inclure les classes nécessaires de PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $nom = htmlspecialchars(trim($_POST["nom"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Créer une instance de PHPMailer
    $mail = new PHPMailer\PHPMailer\PHPMailer(true); // true pour activer les exceptions

    try {
        // Configurer PHPMailer pour utiliser SMTP
        $mail->isSMTP();  // Utiliser le protocole SMTP
        $mail->Host       = 'smtp.gmail.com';  // Serveur SMTP de Gmail
        $mail->SMTPAuth   = true;  // Activer l'authentification SMTP
        $mail->Username   = 'tonemail@gmail.com'; // Remplace avec ton adresse Gmail
        $mail->Password   = 'ton-mot-de-passe-app'; // Remplace avec ton mot de passe d’application Gmail
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS; // Utiliser TLS
        $mail->Port       = 587; // Port SMTP pour TLS

        // Expéditeur et destinataire
        $mail->setFrom('tonemail@gmail.com', 'TOKOTANY BE MALAGASY');  // Ton email d’expéditeur
        $mail->addAddress('destinataire@example.com', 'Nom Destinataire');  // Email du destinataire

        // Contenu du message
        $mail->isHTML(true);  // Activer le format HTML
        $mail->Subject = "Message de contact : $nom"; // Sujet du message
        $mail->Body    = "
            <h2>Message de $nom</h2>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong><br>$message</p>
        "; // Contenu HTML du message

        // Envoi de l'email
        if ($mail->send()) {
            echo "<script>alert('Message envoyé avec succès !'); window.location.href='confirmation.html';</script>";
        } else {
            echo "<script>alert('Erreur lors de l\'envoi du message.'); window.history.back();</script>";
        }
    } catch (Exception $e) {
        // En cas d'erreur lors de l'envoi
        echo "<script>alert('Erreur : {$mail->ErrorInfo}'); window.history.back();</script>";
    }
} else {
    // Si la méthode de requête n'est pas POST, rediriger vers la page de contact
    header("Location: contact.html");
    exit();
}
?>
