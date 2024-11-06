<?php
/*
* Template Name: Formulaire de Contact
*/
get_header();
?>

<div class="contact-form-container">
    <h2>Contactez-nous</h2>
    <form id="contactForm" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="POST">
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" placeholder="Votre nom" required />
        </div>

        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="Votre email" required />
        </div>

        <div class="form-group">
            <label for="message">Message :</label>
            <textarea id="message" name="message" placeholder="Votre message" required></textarea>
        </div>

        <button type="submit" name="submit" class="submit-button">Envoyer</button>
    </form>

    <?php
    // Traitement du formulaire (si envoyé)
    if (isset($_POST['submit'])) {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);

        // Validation des données
        if (!is_email($email)) {
            echo '<p>Adresse email invalide.</p>';
        } else {
            // Envoi de l'email
            $to = 'ton-email@exemple.com'; // Remplace par ton adresse email
            $subject = 'Message de contact depuis le site';
            $headers = 'From: ' . $email . "\r\n" .
                       'Reply-To: ' . $email . "\r\n" .
                       'X-Mailer: PHP/' . phpversion();
            $body = "Nom: $name\nEmail: $email\n\nMessage:\n$message";

            if (wp_mail($to, $subject, $body, $headers)) {
                echo '<p>Merci de nous avoir contacté, nous reviendrons vers vous bientôt.</p>';
            } else {
                echo '<p>Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer.</p>';
            }
        }
    }
    ?>
</div>

<?php get_footer(); ?>
