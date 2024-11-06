<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title(); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
    <?php wp_head(); ?>

    <!-- Ajout de la fonction toggleMenu -->
    <script>
        function toggleMenu() {
            const navMenu = document.getElementById('navMenu');
            const burgerMenu = document.querySelector('.burger-menu');
            navMenu.classList.toggle('active');  // Toggle the navigation menu visibility
            burgerMenu.classList.toggle('active');  // Toggle the burger to a cross
        }
    </script>

</head>
<body <?php body_class(); ?>>
    <header>
        <div class="header-container">
        <div class="logo">
    <a href="<?php echo esc_url(home_url()); ?>">
        <img class="logoheader" src="<?php echo get_template_directory_uri(); ?>/images/LOGO-COMPLET-BLANC.png" alt="Logo NexusBattles" />
        <?php bloginfo('name'); ?>
    </a>
</div>


            <!-- Menu Burger -->
            <div class="burger-menu" onclick="toggleMenu()">
                <div class="burger-line"></div>
                <div class="burger-line"></div>
                <div class="burger-line"></div>
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
</body>
</html>
