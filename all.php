<?php
/*
 * Template Name: All
 */

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
$posts = new WP_Query(array(
	'post_per_pages' => get_option('post_per_pages'),
	'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
	'order' => $order,
	'orderby' => $order_by,
	'meta_query' => array(
		'relation' => 'AND',
		array(
			'key' => 'status',
			'value' => 'upcoming',
			'compare' => '!='
		), array(
			'key' => 'mimi_post_views_count',
			'value' => '0',
			'compare' => '>=',
			'type' => 'NUMERIC'
		)
	)
));
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
if ($posts->have_posts()): ?>
    <main>
        <article>
            <section id="all">
				<?php mimi_sort_bars('All', $menu); ?>
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