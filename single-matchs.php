<?php
get_header(); ?>

<div class="match-container">
    <h1><?php the_title(); ?></h1>

    <!-- Récupérer les informations du match -->
    <?php
    // Récupérer les champs ACF pour le match
    $date_time = get_field('date-heures'); // Date et heure du match
    $score_a = get_field('score-a'); // Score de l'équipe A
    $score_b = get_field('score-b'); // Score de l'équipe B
    $teams = get_field('equipes'); // Équipes participantes (relation)

    if ($teams) {
        // Récupérer les noms des équipes
        $team_a = get_the_title($teams[0]); // Nom de l'équipe A
        $team_b = get_the_title($teams[1]); // Nom de l'équipe B
    }

    // Afficher les détails du match
    ?>
    <div class="match-details">
        <p><strong>Date :</strong> <?php echo date('d/m/Y H:i', strtotime($date_time)); ?></p>
        <p><strong>Équipes :</strong> <?php echo esc_html($team_a); ?> vs <?php echo esc_html($team_b); ?></p>
        <p><strong>Score :</strong> <?php echo esc_html($score_a); ?> - <?php echo esc_html($score_b); ?></p>
    </div>

    <!-- Afficher les membres des équipes -->
    <div class="team-members">
        <h2><?php echo esc_html($team_a); ?></h2>
        <ul>
            <?php
            // Récupérer et afficher les membres de l'équipe A
            $membres_a = [
                get_field("joueurs-1", $teams[0]),
                get_field("joueurs-2", $teams[0]),
                get_field("joueurs-3", $teams[0]),
                get_field("joueurs-4", $teams[0]),
                get_field("joueurs-5", $teams[0]),
            ];

            global $wpdb;
            foreach ($membres_a as $membre_id) {
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

        <h2><?php echo esc_html($team_b); ?></h2>
        <ul>
            <?php
            // Récupérer et afficher les membres de l'équipe B
            $membres_b = [
                get_field("joueurs-1", $teams[1]),
                get_field("joueurs-2", $teams[1]),
                get_field("joueurs-3", $teams[1]),
                get_field("joueurs-4", $teams[1]),
                get_field("joueurs-5", $teams[1]),
            ];

            foreach ($membres_b as $membre_id) {
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

    
</div>

<?php get_footer(); ?>