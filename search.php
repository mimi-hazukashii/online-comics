<?php
get_header();

$order = 'DESC';
$order_by = 'date';

if (isset($_GET['sort'])) {
  switch ($_GET['sort']) {
    case 'views':
      $order = 'DESC';
      $order_by = 'meta_value_num';
      break;
    case 'asc':
      $order = 'ASC';
      $order_by = 'title';
      break;
    case 'desc':
      $order = 'DESC';
      $order_by = 'title';
      break;
    default:
      $order = 'DESC';
      $order_by = 'date';
  }
}

$args = array(
  'post_type' => 'post',
  'posts_per_page' => get_option('posts_per_page'),
  'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
  'order' => $order,
	'orderby' => $order_by,
  's' => isset($_GET['s']) ? $_GET['s'] : null
);

$posts = new WP_Query($args);

$s = str_replace(' ', '+', $posts->query_vars['s']);

$menu = array(
  array(
    'name' => 'Views',
    'url' => "/?s=$s&sort=views"
  ), array(
    'name' => 'Title ASC',
    'url' => "/?s=$s&sort=asc"
  ), array(
    'name' => 'Title DESC',
    'url' => "/?s=$s&sort=desc"
  )
);
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