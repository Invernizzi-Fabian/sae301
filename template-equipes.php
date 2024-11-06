<?php
/* Template Name: equipes-all */

get_header();
?>

<div class="equipes-all">
    <!-- Titre de la page avec l'image de fond -->
    <h1>Équipes participant au tournoi</h1>

    <!-- Traiter le formulaire de création d'équipe -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['creer_equipe_nonce']) && wp_verify_nonce($_POST['creer_equipe_nonce'], 'creer_equipe')) {
        $nom_equipe = sanitize_text_field($_POST['nom_equipe']);
        $membres = array_map('intval', [$_POST['membre_1'], $_POST['membre_2'], $_POST['membre_3'], $_POST['membre_4'], $_POST['membre_5']]);

        // Insérer le post pour la nouvelle équipe
        $new_team_id = wp_insert_post([
            'post_title' => $nom_equipe,
            'post_type' => 'equipes',
            'post_status' => 'publish',
            'meta_input' => array(
                'joueurs-1' => $membres[0],
                'joueurs-2' => $membres[1],
                'joueurs-3' => $membres[2],
                'joueurs-4' => $membres[3],
                'joueurs-5' => $membres[4],
            )
        ]);

        // Traiter le logo de l'équipe
        if (!empty($_FILES['image_equipe']['name'])) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');

            // Téléverser l'image et obtenir l'ID de l'attachement
            $logo_id = media_handle_upload('image_equipe', $new_team_id);

            // Vérifier si l'upload a réussi sans erreurs
            if (!is_wp_error($logo_id)) {
                // Assigner l'ID de l'image au champ ACF "logo"
                update_field('logo', $logo_id, $new_team_id);
            }
        }

        // Rediriger après la création
        echo '<script>window.location.href = "' . get_permalink(get_page_by_path('les-equipes')) . '";</script>';
        exit;
    }

    // Paramètres de la requête pour récupérer les équipes existantes
    $args = array('post_type' => 'equipes');
    $the_query = new WP_Query($args);

    // Bouton et formulaire de création d'équipe
    ?>
    <div class="create-team-section">
        <button id="show-create-form" class="create-team-btn">Créer une nouvelle équipe</button>

        <div id="create-form" style="display: none;">
            <h2>Créer une équipe</h2>
            <form method="post" enctype="multipart/form-data">
                <?php wp_nonce_field('creer_equipe', 'creer_equipe_nonce'); ?>
                <p>
                    <label for="nom_equipe">Nom de l'équipe :</label>
                    <input type="text" id="nom_equipe" name="nom_equipe" required>
                </p>
                <p>
                    <label for="image_equipe">Logo de l'équipe :</label>
                    <input type="file" id="image_equipe" name="image_equipe">
                </p>
                <p>
                    <label>Joueurs :</label><br>
                    <?php
                    $users = get_users();
                    for ($i = 1; $i <= 5; $i++) {
                        echo '<select name="membre_' . $i . '" class="member-select" required>';
                        echo '<option value="">Sélectionner un membre</option>';
                        foreach ($users as $user) {
                            echo '<option value="' . esc_attr($user->ID) . '">' . esc_html($user->display_name) . '</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                </p>
                <input type="submit" value="Créer l'équipe" class="create-team-submit">
            </form>
        </div>
    </div>

    <script>
    document.getElementById('show-create-form').addEventListener('click', function () {
        var form = document.getElementById('create-form');
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    });

    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[name="projet[]"]');
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', function () {
                const checked = document.querySelectorAll('input[name="projet[]"]:checked');
                if (checked.length > 4) {
                    alert('Vous ne pouvez sélectionner que 4 projets.');
                    this.checked = false;
                }
            });
        });
    });
    </script>

    <?php if ($the_query->have_posts()) : ?>
        <div class="toutes-les-equipes">
            
            <ul>
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <li class="equipe-card">
                        <?php 
                        $logo_id = get_field('logo'); 
                        if ($logo_id): 
                            echo wp_get_attachment_image($logo_id, 'thumbnail', false, ['class' => 'equipe-logo', 'alt' => get_the_title() . ' Logo']);
                        else: ?>
                            <p>Aucun logo n'est défini pour cette équipe.</p>
                        <?php endif; ?>
                        <h3 class="equipe-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    <?php else : ?>
        <p>Aucune équipe n'a été trouvée.</p>
    <?php endif;

    wp_reset_postdata();
    get_footer();
?>
