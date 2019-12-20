<?php
get_header();

$args = array(
  'posts_per_page' => get_option('posts_per_page'),
  'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
  's' => isset($_GET['s']) ? $_GET['s'] : null
);

$menu = array(
	array(
		'name' => 'Views',
		'url' => '/all?sort=views'
	), array(
		'name' => 'Title ASC',
		'url' => '/all?sort=asc'
	), array(
		'name' => 'Title DESC',
		'url' => '/all?sort=desc'
	)
);

$posts = new WP_Query($args);

if ($posts->have_posts()): ?>
  <main>
    <article>
      <section id="search">
        <?php mimi_sort_bars('Found ' . $posts->found_posts . ' results.', $menu); ?>
        <div class="row">
          <?php
          while ($posts->have_posts()):
            $posts->the_post();
            get_template_part('template-parts/post');
          endwhile;
          ?>
        </div>
        <?php mimi_pagination($posts->query_vars['paged'], $posts->max_num_pages); ?>
      </section>
    </article>
  </main>
<?php endif;

wp_reset_postdata();
get_footer();