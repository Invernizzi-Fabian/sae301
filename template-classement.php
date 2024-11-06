<?php
/* Template Name: Classement */

get_header(); ?>

<div class="classement-container">
    <h1>Suivez les Leaders du Tournoi</h1>
    <p class="date" >11/11 - 17/11</p>
    
    <!-- Conteneur centré pour le tableau -->
    <div class="classement-table-wrapper">
        <table class="classement-table">
            <thead>
                <tr>
                    <th>RANK</th>
                    <th>Équipe</th>
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
                        $points = get_field('points');       // Récupérer le nombre de points
                        ?>
                        <tr>
                            <td><?php echo esc_html($rank); ?></td>
                            <td>
                                <div class="equipe-info">
                                    <?php if ($logo_id): ?>
                                        <?php echo wp_get_attachment_image($logo_id, 'thumbnail', false, ['class' => 'equipe-logo', 'alt' => get_the_title() . ' Logo']); ?>
                                    <?php else: ?>
                                        <p>Aucun logo n'est défini pour cette équipe.</p>
                                    <?php endif; ?>
                                    <p class="equipe-nom"><?php the_title(); ?></p>
                                </div>
                            </td>
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
</div>

<?php get_footer(); ?>
