<?php
/* Template Name: Login */

// Inclure l'en-tete WordPress
get_header(); 

// Vérifier si le formulaire de connexion a été soumis
if (isset($_POST['login'])) {
    $creds = array();
    $creds['user_login'] = sanitize_text_field($_POST['username']);
    $creds['user_password'] = $_POST['password'];
    $creds['remember'] = true;

    // Essayer de connecter l'utilisateur
    $user = wp_signon($creds, false);

    // Vérifier si la connexion a réussi
    if (is_wp_error($user)) {
        echo '<div class="error">' . $user->get_error_message() . '</div>';
    } else {
        // Redirige vers la page d'accueil après la connexion
        wp_redirect(home_url());
        exit;
    }
}
?>

<!-- Formulaire de connexion -->
<form method="post">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" name="username" required>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required>

    <input type="submit" name="login" value="Connexion">
</form> 
