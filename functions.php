<?php
// vignettes
// vignettes
add_theme_support( 'post-thumbnail' );
add_theme_support( 'post-thumbnails' );
// menus
the_post_thumbnail( 'thumbnail' );

function theme_enqueue_styles() {
    wp_enqueue_style('main-styles', get_stylesheet_uri());
  }
  add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

  function charger_styles_formulaire() {
    // Enregistre et charge le fichier CSS uniquement pour les pages utilisant le formulaire
    if (is_page('inscription')) {  // Remplace 'inscription' par le slug de la page si nécessaire
        wp_enqueue_style('style-formulaire', get_template_directory_uri() . '/style.css');
    }
}
add_action('wp_enqueue_scripts', 'charger_styles_formulaire');


// Fonction pour enregistrer plusieurs menus
function mon_joli_theme_register_menus() {
    register_nav_menus(array(
        'menu-principal' => ('Menu Principal'),
        'menu-secondaire' => ('Menu Secondaire'),
    ));
}



// Action pour initialiser les menus
add_action('after_setup_theme', 'mon_joli_theme_register_menus');



//ajouter une nouvelle zone de menu à mon thème
function register_my_menu(){
    register_nav_menus( array(
        'header-menu' => __( 'Menu De Tete'),
        'footer-menu'  => __( 'Menu De Pied'),
    ) );
}
add_action( 'init', 'register_my_menu', 0 );


// Fonction pour afficher le formulaire d'inscription


function afficher_formulaire_inscription() {
    if (is_user_logged_in()) {
        return 'Vous êtes déjà connecté.';
    }

    $output = '
    <form id="formulaire-inscription" action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post">
        <div>
            <label for="user_login">Identifiant</label>
            <input type="text" name="user_login" id="user_login" required>
        </div>
        <div>
            <label for="user_email">Adresse e-mail</label>
            <input type="email" name="user_email" id="user_email" required>
        </div>
        <div>
            <label for="user_firstname">Prénom</label>
            <input type="text" name="user_firstname" id="user_firstname" required>
        </div>
        <div>
            <label for="user_lastname">Nom</label>
            <input type="text" name="user_lastname" id="user_lastname" required>
        </div>
        <div>
            <label for="user_pass">Mot de passe</label>
            <input type="password" name="user_pass" id="user_pass" required>
        </div>
        <div>
            <label for="user_pass_confirm">Confirmer le mot de passe</label>
            <input type="password" name="user_pass_confirm" id="user_pass_confirm" required>
        </div>
        ' . wp_nonce_field('inscription_utilisateur_nonce', '_wpnonce', true, false) . '
        <input type="submit" value="S\'inscrire">
    </form>';

    return $output;
}



function custom_menu_items($items, $args) {
    // Vérifie si l'utilisateur est connecté
    if (is_user_logged_in()) {
        // Enlève le lien de connexion du menu
        $items = preg_replace('/<li><a href=".*?wp-login.php.*?">Connexion<\/a><\/li>/', '', $items);
        
        // Enlève le lien d'inscription du menu
        $items = preg_replace('/<li><a href=".*?\/inscription.*?">Inscription<\/a><\/li>/', '', $items);

        // Ajoute le lien de déconnexion avec une classe personnalisée pour le style
        $items .= '<li class="menu-item logout-menu-item"><a href="' . wp_logout_url(home_url()) . '">Déconnexion</a></li>';
    } else {
        // Ajoute le lien de connexion s'il n'est pas connecté
        $items .= '<li class="menu-item"><a href="' . site_url('/Connexion') . '">Connexion</a></li>';
        
        // Ajoute le lien d'inscription s'il n'est pas connecté
        $items .= '<li class="menu-item"><a href="' . site_url('/inscription') . '">Inscription</a></li>';
    }
    
    return $items;
}
add_filter('wp_nav_menu_items', 'custom_menu_items', 10, 2);

 


?>

