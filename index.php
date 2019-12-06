<?php get_header(); ?>
  <div id="content">
    <div class="container">
      <?php mimi_title_bar(__('Recommend', 'mimi'), '#'); ?>
      <?php get_template_part('template-parts/carousel'); ?>
    </div>
    <div class="container">
      <?php mimi_title_bar(__('Latest Update', 'mimi'), '#'); ?>
      <?php get_template_part('template-parts/content'); ?>
    </div>
    <div class="container">
      <?php mimi_title_bar(__('Upcoming', 'mimi'), '#'); ?>
      <?php get_template_part('template-parts/carousel'); ?>
    </div>
  </div>
<?php get_footer(); ?>