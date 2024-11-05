<!DOCTYPE html>
<html>
  <head <?php language_attributes(); ?>>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php the_title(); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
    <?php wp_head(); ?>

    <?php 
wp_nav_menu ( array (
 'theme_location' => 'header-menu' 
 ) ); ?>

  </head>
  <body>
    <div class="wrap">
      <header>
        <h1><a><?php bloginfo('name'); ?></a></h1>
        <h2><?php bloginfo('description'); ?></h2>
      </header>