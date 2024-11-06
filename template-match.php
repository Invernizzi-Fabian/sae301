
    <?php
/* Template Name: liste-match */
get_header(); ?>

<div class="matches-container">
    <div class="header" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/imageaccueil.webp');">
    <div class="matches-container">
    <h1 class="equipesh2" >Suivez les Rencontres à Venir</h1>
</div>
    </div>


    <?php
    // Arguments pour récupérer tous les matchs
    $args = array(
        'post_type' => 'matchs', // Le type de publication des matchs
        'posts_per_page' => -1,  // Afficher tous les matchs
        'orderby' => 'date',     // Trier par date
        'order' => 'ASC'         // Ordre croissant
    );

    // La requête
    $match_query = new WP_Query($args);

    // Vérifier si des matchs ont été trouvés
    if ($match_query->have_posts()) :
        echo '<ul class="match-list">';
        while ($match_query->have_posts()) : $match_query->the_post();
            // Récupérer les champs ACF
            $teams = get_field('equipes'); // Les équipes participantes (relation)
            $score_a = get_field('score-a'); // Score de l'équipe A
            $score_b = get_field('score-b'); // Score de l'équipe B
            // Récupérer les logos des équipes
            $team_a_logo = get_field('logo', $teams[0]->ID); // Logo équipe A
            $team_b_logo = get_field('logo', $teams[1]->ID); // Logo équipe B
            ?>
            <li class="match-item">
                <a href="<?php the_permalink(); ?>" class="match-card">
                    <div class="team">
                        <span class="team-name"><?php echo substr(get_the_title($teams[0]), 0, 3); ?></span>
                        
                        <?php if ($team_a_logo) : ?>
                            <div class="team-logo team-a-logo">
                                <img src="<?php echo esc_url(wp_get_attachment_url($team_a_logo)); ?>" alt="<?php echo esc_attr(get_the_title($teams[0]->ID)); ?> Logo">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="score">
                        <span><?php echo esc_html($score_a); ?> - <?php echo esc_html($score_b); ?></span>
                    </div>
                    <div class="team">
                        <?php if ($team_b_logo) : ?>
                            <div class="team-logo team-b-logo">
                                <img src="<?php echo esc_url(wp_get_attachment_url($team_b_logo)); ?>" alt="<?php echo esc_attr(get_the_title($teams[1]->ID)); ?> Logo">
                            </div>
                        <?php endif; ?>
                        <span class="team-name"><?php echo substr(get_the_title($teams[1]), 0, 3); ?></span>
                    </div>
                    <div class="arrow">
                        <span>&#8594;</span> <!-- Flèche droite -->
                    </div>
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