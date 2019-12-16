<?php
define('WP_MAINTENANCE', false);
define('DEFAULT_POST_THUMBNAIL', '#');

add_filter('show_admin_bar', '__return_false');
add_filter('query_vars', 'mimi_add_query_vars');

if (!function_exists('mimi_theme_setup')) {
	function mimi_theme_setup() {
		load_theme_textdomain('mimi', get_template_directory_uri() . '/languages');

		add_theme_support('automatic-feed-links');
	}
	add_action('after_setup_theme', 'mimi_theme_setup');
}

if (!function_exists('mimi_maintenance')) {
	function mimi_maintenance() {
		if (WP_MAINTENANCE && !current_user_can('administrator')) {
			$message = '<h1>' . get_bloginfo('name') . ' Maintenance</h1><p>Time to relax your hand and drink tea!</p>';
			$title = get_bloginfo('name') . ' Maintenance';
			wp_die($message, $title, array(
				'response' => 503
			));
		}
	}
	add_action('get_header', 'mimi_maintenance');
}

if (!function_exists('mimi_add_query_vars')) {
	function mimi_add_query_vars($vars) {
		$vars[] = 'mimi_action';
		$vars[] = 'mimi_chapter';
		return $vars;
	}
}

if (!function_exists('mimi_add_rewrite_rule')) {
	function mimi_add_rewrite_rule() {
		add_rewrite_rule('^([^/]+)/chapter-(.*)$',
            'index.php?name=$matches[1]&mimi_action=read&mimi_chapter=$matches[2]',
			'top');
		flush_rewrite_rules();
	}
	add_action('init', 'mimi_add_rewrite_rule');
}

if (!function_exists('mimi_create_templates')) {
	function mimi_create_templates() {
		if (isset($_GET['activated']) && is_admin()) {
			$templates = array(
				array(
					'title' => 'All',
					'filename' => 'all.php'
				), array(
					'title' => 'Popular',
					'filename' => 'popular.php'
				), array(
					'title' => 'Upcoming',
					'filename' => 'upcoming.php'
				)
			);
			foreach ($templates as $template) {
				if (!isset(get_page_by_title($template['title'])->ID)) {
					$page_id = wp_insert_post(array(
						'post_title' => $template['title'],
						'post_status' => 'publish',
						'post_type' => 'page'
					));
					update_post_meta($page_id, '_wp_page_template', $template['filename']);
				}
			}
		}
	}
	add_action('after_switch_theme', 'mimi_create_templates');
}

if (!function_exists('mimi_create_author')) {
	function mimi_create_author() {
		$args = array(
			'labels' => array(
				'name' => _x('Authors', 'taxonomy general name', 'mimi'),
				'singular_name' => _x('Author', 'taxonomy singular name', 'mimi'),
				'search_items' => __('Search Authors', 'mimi'),
				'all_items' => __('All Authors', 'mimi'),
				'edit_item' => __('Edit Author', 'mimi'),
				'update_item' => __('Update Author', 'mimi'),
				'add_new_item' => __('Add New Author', 'mimi'),
				'new_item_name' => __('New Author Name', 'mimi'),
				'menu_name' => __('Authors', 'mimi')
			),
			'show_in_rest' => true
		);
		register_taxonomy('authors', 'post', $args);
	}
	add_action('init', 'mimi_create_author', 0);
}

if (!function_exists('mimi_set_post_views')) {
	function mimi_set_post_views() {
		$post_id = get_the_ID();
		$count = get_post_meta($post_id, 'mimi_post_views_count', true);
		if ($count === false) {
			delete_post_meta($post_id, 'mimi_post_views_count');
			add_post_meta($post_id, 'mimi_post_views_count', 0);
		} else {
			update_post_meta($post_id, 'mimi_post_views_count', ++$count);
		}
	}
}

if (!function_exists('mimi_get_post_views')) {
	function mimi_get_post_views() {
		$count = get_post_meta(get_the_ID(), 'mimi_post_views_count', true);
		return $count ? $count : '0';
	}
}

if (!function_exists('mimi_title_bars')) {
	function mimi_title_bars($title, $url) { ?>
        <div class="title-bars">
            <div class="row">
                <div class="col">
                    <h2><?php echo $title; ?></h2>
                </div>
                <div class="col text-right">
                    <a class="view" href="<?php echo $url; ?>">View All</a>
                </div>
            </div>
        </div>
	<?php }
}

if (!function_exists('mimi_sort_bars')) {
	function mimi_sort_bars($title, $sort) { ?>
        <div class="title-bars">
            <div class="row">
                <div class="col">
                    <h2><?php echo $title; ?></h2>
                </div>
                <div class="col text-right">
                    <div class="dropdown">
                        <span class="sort dropdown-toggle" data-toggle="dropdown">Sort by</span>
                        <div class="dropdown-menu">
							<?php foreach ($sort as $item): ?>
                                <a class="dropdown-item" href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>
							<?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php }
}

if (!function_exists('mimi_pagination')) {
	function mimi_pagination($paged, $pages, $range = 2) {
		if ($pages > 1): ?>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="<?php echo get_pagenum_link(); ?>"><i class="fas fa-angle-double-left"></i></a>
                </li>
				<?php for ($i = $paged - $range; $i < $paged; ++$i):
					if ($i >= 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo get_pagenum_link($i); ?>"><?php echo $i; ?></a>
                        </li>
					<?php endif;
				endfor; ?>
                <li class="page-item active">
                    <a class="page-link" href="<?php echo get_pagenum_link($paged); ?>"><?php echo $paged; ?></a>
                </li>
				<?php for ($i = $paged + 1; $i <= $paged + $range; ++$i):
					if ($i <= $pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo get_pagenum_link($i); ?>"><?php echo $i; ?></a>
                        </li>
					<?php endif;
				endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo get_pagenum_link($pages); ?>"><i class="fas fa-angle-double-right"></i></a>
                </li>
            </ul>
		<?php endif;
	}
}

if (!function_exists('mimi_get_post_thumbnail')) {
	function mimi_get_post_thumbnail() {
	    $thumbnail = get_field('thumbnail');
	    if (empty($thumbnail))
	        $thumbnail = DEFAULT_POST_THUMBNAIL;
	    return $thumbnail;
    }
}