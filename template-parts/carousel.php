<div class="item">
    <div class="wrap-post">
        <a href="<?php the_permalink(); ?>">
            <img class="owl-lazy" src="" data-src="<?php the_field('thumbnail'); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
            <h3 class="title"><?php the_title(); ?></h3>
        </a>
        <span class="views"><i class="fas fa-eye"></i> <?php echo mimi_get_post_views(get_the_ID()); ?></span>
    </div>
</div>