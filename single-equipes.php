<?php
get_header(); ?>

<div class="equipe-container">
    <h1><?php the_title(); ?></h1>

    <!-- Récupérer les champs ACF pour l'équipe -->
    <?php
    $logo = get_field('logo'); // Champ pour le logo
    $victoires = get_field('victoires'); // Victoires
    $defaites = get_field('defaites'); // Défaites
    $points = get_field('points'); // Points

    // Afficher les informations de l'équipe
    if ($logo) {
        echo '<img src="' . esc_url($logo['url']) . '" alt="' . esc_attr($logo['alt']) . '">';
    }
    echo '<p>Victoires : ' . esc_html($victoires) . '</p>';
    echo '<p>Défaites : ' . esc_html($defaites) . '</p>';
    echo '<p>Points : ' . esc_html($points) . '</p>';

    echo '<h2>Joueurs</h2>';
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

    // Récupérer les matchs associés à l'équipe
    $match_ids = get_field('matchs-selon-equipe'); // Récupérer les IDs des matchs
    if ($match_ids) {
        echo '<h2>Matchs</h2>';
        echo '<ul class="match-list">';
        
        // Boucle à travers les IDs des matchs
       // Boucle à travers les IDs des matchs
       foreach ($match_ids as $match_id) {
        $match = get_post($match_id); // Obtenir l'objet du match
        $score_a = get_field('score-a', $match_id); // Récupérer le score de l'équipe A
        $score_b = get_field('score-b', $match_id); // Récupérer le score de l'équipe B
        $date_time = get_field('date-heures', $match_id); // Récupérer la date/heure du match
        
        // Afficher chaque match avec un lien vers la page unique
        ?>
        <li class="match-item">
            <a href="<?php echo esc_url(get_permalink($match_id)); ?>">
                <h3><?php echo esc_html($match->post_title); ?></h3>
                <p>Date : <?php echo date('d/m/Y H:i', strtotime($date_time)); ?></p>
                <p>Score : <?php echo esc_html($score_a); ?> - <?php echo esc_html($score_b); ?></p>
            </a>
        </li>
        <?php
    }
    echo '</ul>';
} else {
    echo '<p>Aucun match joué par cette équipe.</p>';
}
?>
</div>

<?php get_footer(); ?>