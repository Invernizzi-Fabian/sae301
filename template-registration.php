<?php
/* Template Name: Registration */
// Inclure le header de WordPress
get_header();

// Vérifier si le formulaire d'inscription a été soumis
if (isset($_POST['submit'])) {
    // Récupérer et assainir les données du formulaire
    $username = sanitize_user($_POST['username']);
    $password = $_POST['password'];
    $email = sanitize_email($_POST['email']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);

    // Vérifier si l'utilisateur existe déjà
    if (username_exists($username) || email_exists($email)) {
        echo '<div class="error">Erreur : Le nom d’utilisateur ou l’adresse e-mail est déjà utilisé.</div>';
    } else {
        // Créer un nouvel utilisateur
        $userdata = array(
            'user_login' => $username,
            'user_email' => $email,
            'user_pass' => $password, // Le mot de passe sera automatiquement haché
            'first_name' => $first_name,
            'last_name' => $last_name,
            'role' => 'contributor' // Définir le rôle comme contributeur
        );

        // Insérer l'utilisateur dans la base de données
        $user_id = wp_insert_user($userdata);

        // Vérifier si l'utilisateur a été créé avec succès
        if (!is_wp_error($user_id)) {
            // Enregistrement réussi
            echo '<div class="success">Enregistrement réussi. Vous pouvez vous connecter maintenant.</div>';
            // Rediriger vers la page de connexion par défaut de WordPress après l'inscription
            wp_redirect(wp_login_url());
            wp_redirect(home_url('/connexion'));
            exit; // Arrêter l'exécution du script
        } else {
            echo '<div class="error">Erreur : ' . $user_id->get_error_message() . '</div>';
        }
    }
}
?>

<!-- CSS intégré pour le style du formulaire -->
<style>
    .form-inscription {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
    text-align: center; /* Centre le contenu du formulaire */
    margin-bottom: 60px; /* Ajoute de l'espace en dessous du cadre d'inscription */
}

.form-title {
    text-align: center;
    color: #A4FFFF; /* Couleur modifiée en bleu clair */
    margin-bottom: 20px;
    font-size: 36px; /* Taille du titre agrandie */
    font-family: 'Arial', sans-serif; /* Changer la police pour plus de style */
    font-weight: bold; /* Mettre le titre en gras */
    padding: 20px 0; /* Ajoute de l'espace en haut et en bas du titre */
}

.form-inscription label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: black; /* Couleur noire pour les labels */
}

.form-inscription input[type="text"],
.form-inscription input[type="password"],
.form-inscription input[type="email"],
.form-inscription input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.form-inscription input[type="submit"] {
    background-color: #A4FFFF; /* Applique la couleur bleu clair au bouton */
    color: black; /* Texte en noir pour le bouton */
    border: none;
    cursor: pointer;
    margin-top: 10px; /* Espace entre le champ de saisie et le bouton */
}

.form-inscription input[type="submit"]:hover {
    background-color: #8be3e3; /* Couleur plus claire au survol du bouton */
}

.error {
    color: red;
    margin-bottom: 15px;
    text-align: center; /* Centre le texte d'erreur */
}

.success {
    color: green;
    margin-bottom: 15px;
    text-align: center; /* Centre le texte de succès */
}

</style>

<!-- Titre global -->
<h1 class="form-title">Inscription</h1>

<!-- Formulaire d'inscription -->
<form class="form-inscription" method="post">
    <label for="username">Nom d'utilisateur</label>
    <input type="text" id="username" name="username" required>
    
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" required>
    
    <label for="email">Adresse e-mail</label>
    <input type="email" id="email" name="email" required>
    
    <label for="first_name">Prénom</label>
    <input type="text" id="first_name" name="first_name" required>
    
    <label for="last_name">Nom</label>
    <input type="text" id="last_name" name="last_name" required>
    
    <input type="submit" name="submit" value="S'inscrire">
</form>

<?php
// Inclure le footer de WordPress
get_footer();
?>
