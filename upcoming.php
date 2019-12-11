<?php
/*
 * Template Name: All
 */

get_header();
$paged = get_query_var('paged');
if (!$paged)
    $paged = 1;
$posts = new WP_Query(array(
    'posts_per_page' => get_option('posts_per_page'),
    'paged' => $paged,
    'meta_query' => array(
        array(
            'key' => 'status',
            'value' => 'upcoming'
        )
    )
));
$sort = array(
    array(
        'name' => 'Views',
        'link' => '#'
    ), array(
        'name' => 'ASC Title',
        'link' => '#'
    ), array(
        'name' => 'DESC Title',
        'link' => '#'
    )
);
if ($posts->have_posts()): ?>
    <div id="content">
        <div class="container">
            <?php mimi_sort_bar(__('Upcoming', 'mimi'), $sort); ?>
            <div class="row">
                <?php
                while ($posts->have_posts()) {
                    $posts->the_post();
                    get_template_part('template-parts/content');
                }
                ?>
            </div>
        </div>
        <?php mimi_pagination($posts->query_vars['paged'], $posts->max_num_pages); ?>
    </div>
<?php endif;
wp_reset_postdata();
get_footer(); ?>