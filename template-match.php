<?php
/* Template Name: match-all */
get_header(); ?>

<div class="matches-container">
    <h1>Tous les Matchs</h1>

    <?php
    // Arguments pour récupérer tous les matchs
    $args = array(
        'post_type' => 'matchs', // Le type de publication des matchs
        'posts_per_page' => -1,  // Afficher tous les matchs
        'orderby' => 'date',      // Trier par date
        'order' => 'ASC'          // Ordre croissant
    );

    // La requête
    $match_query = new WP_Query($args);

    // Vérifier si des matchs ont été trouvés
    if ($match_query->have_posts()) :
        echo '<ul class="match-list">';
        while ($match_query->have_posts()) : $match_query->the_post();
            // Récupérer les champs ACF
            $teams = get_field('equipes'); // Équipes participantes (relation)
            $score_a = get_field('score-a'); // Récupérer le score de l'équipe A
            $score_b = get_field('score-b'); // Récupérer le score de l'équipe B
            
            // Afficher chaque match avec un lien vers la page unique
            ?>
            <li class="match-item">
                <a href="<?php the_permalink(); ?>">
                    <h2><?php the_title(); ?></h2>
                    <p>Équipes : <?php echo esc_html(get_the_title($teams[0])); ?> vs <?php echo esc_html(get_the_title($teams[1])); ?></p>
                    <p>Score : <?php echo esc_html($score_a); ?> - <?php echo esc_html($score_b); ?></p>
                </a>
            </li>
            <?php
        endwhile;
        echo '</ul>';
    else :
        echo '<p>Aucun match à afficher.</p>';
    endif;

    // Réinitialiser la requête
    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>