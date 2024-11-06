<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title(); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header>
        <div class="header-container">
            <!-- Logo avec texte à droite -->
            <div class="logo">
                <a href="<?php echo esc_url(home_url("/accueil")); ?>">
                    <!-- Affichage du logo -->
                    <img src="<?php echo get_template_directory_uri(); ?>/images/LOGO-SEUL-BLANC.png" alt="Logo" class="logo-image" />
                </a>
                <!-- Texte à droite du logo -->
                <a href="<?php echo esc_url(home_url("/accueil")); ?>" class="logo-text-link">
                    <span class="logo-text">NexusBattles</span>
                </a>
            </div>

            <!-- Menu Burger -->
            <div class="burger-menu" id="burgerMenu" onclick="toggleMenu()">
                <div class="burger-line" id="line1"></div>
                <div class="burger-line" id="line2"></div>
                <div class="burger-line" id="line3"></div>
            </div>

            <!-- Navigation Menu -->
            <nav id="navMenu" class="nav-menu">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'header-menu', // Menu de navigation
                        'container' => false,
                        'menu_class' => 'menu-list',
                    ) );
                ?>
            </nav>
        </div>
    </header>

    <div class="wrap">
        <!-- Contenu de la page ici -->

        <!-- Inclusion de la fonction JavaScript -->
        <script>
            // Fonction pour activer/désactiver le menu burger
            function toggleMenu() {
                const navMenu = document.getElementById('navMenu');
                const burgerMenu = document.getElementById('burgerMenu');
                
                // Ajout/retirer la classe "active" sur le burger et le menu
                burgerMenu.classList.toggle('active');
                navMenu.classList.toggle('active');
            }
        </script>
    </div>
    
    <?php wp_footer(); ?>
  </body>
</html>
