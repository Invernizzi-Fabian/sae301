<?php get_header(); ?>
<div class="equipes">
    <h2 class="page-title">Équipes</h2>
    <?php if (have_posts()) : ?>
        
            <?php while (have_posts()) : the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="equipe"> <!-- Lien autour de l'article -->
                    <?php the_post_thumbnail('thumbnail'); ?>
                    <h1 class="title">
                        <?php the_title(); ?>
                    </h1>
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                </a>
            <?php endwhile; ?>
        
    <?php endif; ?>
</div>
<?php get_footer(); ?>
