<div class="item">
  <div class="wrap-post">
    <a href="<?php the_permalink(); ?>">
      <img class="owl-lazy" src="" data-src="<?php echo mimi_get_post_thumbnail(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
      <h3><?php the_title(); ?></h3>
    </a>
    <span class="views"><i class="fas fa-eye"></i> <?php echo mimi_get_post_views(); ?></span>
  </div>
</div>