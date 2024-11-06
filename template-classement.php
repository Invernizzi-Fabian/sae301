<?php
/* Template Name: Classement */

get_header(); ?>

<div class="classement-container">
    <h1>Classement</h1>
    <p>15/01 - 20/01</p>

    <table class="classement-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Équipe</th>
                <th>V</th>
                <th>D</th>
                <th>Points</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Arguments pour récupérer toutes les équipes, triées par le champ "points" de façon décroissante
            $args = array(
                'post_type' => 'equipes', // Le type de publication des équipes
                'posts_per_page' => -1,   // Afficher toutes les équipes
                'meta_key' => 'points',   // Le champ ACF pour le tri
                'orderby' => 'meta_value_num', // Trier par la valeur numérique du champ
                'order' => 'DESC',        // Ordre décroissant
            );

            // La requête
            $equipe_query = new WP_Query($args);
            $rank = 1; // Initialiser le classement

            // Vérifier si des équipes ont été trouvées
            if ($equipe_query->have_posts()) :
                while ($equipe_query->have_posts()) : $equipe_query->the_post();
                    $logo_id = get_field('logo');      // Récupérer l'ID du logo
                    $victoires = get_field('victoires'); // Récupérer le nombre de victoires
                    $defaites = get_field('defaites');   // Récupérer le nombre de défaites
                    $points = get_field('points');       // Récupérer le nombre de points
                    ?>
                    <tr>
                        <td><?php echo esc_html($rank); ?></td>
                        <td>
                            <?php if ($logo_id): ?>
                                <?php echo wp_get_attachment_image($logo_id, 'thumbnail', false, ['class' => 'equipe-logo', 'alt' => get_the_title() . ' Logo']); ?>
                            <?php else: ?>
                                <p>Aucun logo n'est défini pour cette équipe.</p>
                            <?php endif; ?>
                        </td>
                        <td><?php the_title(); ?></td>
                        <td><?php echo esc_html($victoires); ?></td>
                        <td><?php echo esc_html($defaites); ?></td>
                        <td><?php echo esc_html($points); ?></td>
                    </tr>
                    <?php
                    $rank++; // Incrémenter le rang
                endwhile;
            else :
                echo '<tr><td colspan="6">Aucune équipe à afficher.</td></tr>';
            endif;

            // Réinitialiser la requête
            wp_reset_postdata();
            ?>
        </tbody>
    </table>
</div>

<?php get_footer(); ?>
