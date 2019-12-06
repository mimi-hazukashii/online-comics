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
          <h2 class="title"><?php echo $title; ?></h2>
        </div>
        <div class="col text-right">
          <a class="btn-view" href="<?php echo $permalink; ?>">See All&nbsp;&nbsp;<i class="fas fa-caret-right"></i></a>
        </div>
      </div>
    </div>
  <?php }
}