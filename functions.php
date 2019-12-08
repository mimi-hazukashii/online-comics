<?php
define('TEMPLATE_URI', get_template_directory_uri());

if (!function_exists('mimi_theme_setup')) {
    function mimi_theme_setup() {
        load_theme_textdomain('mimi', TEMPLATE_URI . '/languages');

        add_theme_support('automatic-feed-links');

        register_nav_menu('primary-menu', __('Primary Menu', 'mimi'));
    }
    add_action('after_theme_setup', 'mimi_theme_setup');
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
            'show_in_rest' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'author'),
        );
        register_taxonomy('author', 'post', $args);
    }
    add_action('init', 'mimi_create_author', 0);
}

if (!function_exists('mimi_title_bar')) {
    function mimi_title_bar($title, $permalink) { ?>
        <div class="title-bar">
            <div class="row">
                <div class="col">
                    <h2><?php echo $title; ?></h2>
                </div>
                <div class="col text-right">
                    <a href="<?php echo $permalink; ?>">View All&nbsp;&nbsp;<i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
    <?php }
}

if (!function_exists('mimi_sort_bar')) {
    function mimi_sort_bar($title, $args) { ?>
        <div class="title-bar">
            <div class="row">
                <div class="col">
                    <h2><?php echo $title; ?></h2>
                </div>
                <div class="col text-right">
                    <a href="#">Sort by&nbsp;&nbsp;<i class="fas fa-caret-down"></i></a>
                </div>
            </div>
        </div>
    <?php }
}

if (!function_exists('mimi_set_post_views')) {
    function mimi_set_post_views($post_id) {
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
    function mimi_get_post_views($post_id) {
        $count = get_post_meta($post_id, 'mimi_post_views_count', true);
        return $count === false ? 0 : $count;
    }
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