<?php
get_header();
if (have_posts()) {
  while (have_posts()) {
    the_post(); ?>
    <div id="post-content">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div class="row">
              <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 relative">
                <img class="lazy" data-src="<?php the_field('thumbnail'); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                <span class="views"><i class="fas fa-eye"></i> 6969</span>
              </div>
              <div class="col-xl-9 col-lg-8 col-md-8 col-sm-6">
                <h1><?php the_title(); ?></h1>
                <div class="post-info">
                  <strong>Sub Title:</strong> <?php the_field('sub_title'); ?>
                </div>
                <div class="post-info">
                  <strong>Categories:</strong> <?php the_category(', '); ?>
                </div>
                <div class="post-info">
                  <strong>Author:</strong> <?php the_terms($post_id, 'author', '', ' ,', ''); ?>
                </div>
                <div class="post-info">
                  <strong>Source:</strong> <?php the_field('source'); ?>
                </div>
                <div class="post-info">
                  <strong>Status:</strong> <?php echo ucfirst(get_field('status')); ?>
                </div>
                <div class="post-info">
                  <strong>Tags:</strong> <?php the_tags('', ', ', ''); ?>
                </div>
              </div>
            </div>
            <div class="description my-3">
              <?php the_content(); ?>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="wrap-sidebar">
              <div class="row">
                <div class="col-5 pr-0">
                  <a href="<?php the_permalink(); ?>">
                    <img class="lazy" data-src="<?php the_field('thumbnail'); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                  </a>
                </div>
                <div class="col-7 pl-2">
                  <h2><?php the_title(); ?></h2>
                </div>
              </div>
            </div>
            <div class="wrap-sidebar">
              <div class="row">
                <div class="col-5 pr-0">
                  <a href="<?php the_permalink(); ?>">
                    <img class="lazy" data-src="<?php the_field('thumbnail'); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                  </a>
                </div>
                <div class="col-7 pl-2">
                  <h2><?php the_title(); ?></h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php }
}
get_footer();