<?php 
get_header(); ?>

<div class="equipe-container">
    <h1><?php the_title(); ?></h1>

    <!-- Card de l'équipe -->
    <div class="equipe-details-card">
        <?php
        // Récupérer les champs ACF pour l'équipe
        $logo_id = get_field('logo'); // Récupérer l'ID du logo
        $victoires = get_field('victoires'); // Victoires
        $defaites = get_field('defaites'); // Défaites
        $points = get_field('points'); // Points

        // Afficher le logo de l'équipe
        if ($logo_id) {
            echo wp_get_attachment_image($logo_id, 'full', false, ['class' => 'equipe-logo', 'alt' => get_the_title() . ' Logo']);
        }

        // Afficher les autres informations de l'équipe
        echo '<div class="equipe-info">';
        echo '<p><span>Victoires :</span> ' . esc_html($victoires) . '</p>';
        echo '<p><span>Défaites :</span> ' . esc_html($defaites) . '</p>';
        echo '<p><span>Points :</span> ' . esc_html($points) . '</p>';
        echo '</div>';
        ?>
    </div>

    <!-- Card des joueurs -->
    <div class="equipe-players-card">
        <h2>Joueurs</h2>
        <ul>
            <?php
            $membres = [
                get_field("joueurs-1"),
                get_field("joueurs-2"),
                get_field("joueurs-3"),
                get_field("joueurs-4"),
                get_field("joueurs-5"),
            ];

            global $wpdb;
            foreach ($membres as $membre_id) {
                if ($membre_id) {
                    $user_name = $wpdb->get_var($wpdb->prepare("
                        SELECT display_name 
                        FROM {$wpdb->users}
                        WHERE ID = %d
                    ", $membre_id));
                    if ($user_name) {
                        echo '<li>' . esc_html($user_name) . '</li>';
                    }
                }
            }
            ?>
        </ul>
    </div>

    <!-- Card des matchs -->
    <div class="equipe-matches-card">
        <h2>Matchs</h2>
        <ul class="match-list">
            <?php
            // Récupérer les matchs associés à l'équipe
            $match_ids = get_field('matchs-selon-equipe'); // Récupérer les IDs des matchs
            if ($match_ids) {
                foreach ($match_ids as $match_id) {
                    $match = get_post($match_id); // Obtenir l'objet du match
                    $score_a = get_field('score-a', $match_id); // Récupérer le score de l'équipe A
                    $score_b = get_field('score-b', $match_id); // Récupérer le score de l'équipe B
                    $date_time = get_field('date-heures', $match_id); // Récupérer la date/heure du match
                    ?>
                    <li class="match-item">
                        <a href="<?php echo esc_url(get_permalink($match_id)); ?>">
                            <h3><?php echo esc_html($match->post_title); ?></h3>
                            <p>Date : <span><?php echo date('d/m/Y H:i', strtotime($date_time)); ?></span></p>
                            <p>Score : <span><?php echo esc_html($score_a); ?> - <?php echo esc_html($score_b); ?></span></p>
                        </a>
                    </li>
                    <?php
                }
            } else {
                echo '<p>Aucun match joué par cette équipe.</p>';
            }
            ?>
        </ul>
    </div>
</div>

<?php get_footer(); ?>
