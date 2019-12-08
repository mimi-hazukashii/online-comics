<?php
/*
 * Template Name: Upcoming
 */
get_header();
$posts = new WP_Query(array(
    'posts_per_page' => get_option('posts_per_page'),
    'paged' => get_query_var('paged'),
    'meta_query' => array(
        array(
            'key' => 'status',
            'value' => 'upcoming'
        )
    )
));
?>
    <div id="content">
        <div class="container">
            <?php mimi_sort_bar(__('Upcoming', 'mimi'), '#'); ?>
            <div class="posts-area">
                <div class="row">
                    <?php
                    if ($posts->have_posts()) {
                        while ($posts->have_posts()) {
                            $posts->the_post();
                            get_template_part('template-parts/content');
                        }
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <?php mimi_pagination($posts->query_vars['paged'], $posts->max_num_pages); ?>
        </div>
    </div>
<?php get_footer(); ?>