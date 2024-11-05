<?php get_header(); ?>
<div class="main single">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="post">
    <div>
        <?php the_post_thumbnail("thumbnail"); ?>
    </div>
<h1 class="post-title"><?php the_title(); ?></h1>


<div class="post-content">
<?php the_content(); ?>
</div>
<div class="post-comments">
<?php comments_template(); ?>
</div>
</div>
<?php endwhile; ?>
<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
