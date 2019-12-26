<?php
/*
 * Template Name: Popular
 */

get_header();

$args = array(
    'post_per_pages' => get_option('post_per_pages'),
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    'orderby' => 'meta_value_num',
    'meta_query' => array(
        array(
            'key' => 'status',
            'value' => 'upcoming',
            'compare' => '!='
        )
    )
);

if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'day':
            $args['meta_key'] = 'mimi_views_day';
            break;
        case 'week':
            $args['meta_key'] = 'mimi_views_week';
            break;
        case 'month':
            $args['meta_key'] = 'mimi_views_month';
            break;
        default:
            $args['meta_key'] = 'mimi_post_views_count';
    }
}

$posts = new WP_Query($args);

$menu = array(
    array(
        'name' => 'Daily Top Views',
        'url' => '/popular?sort=day'
    ), array(
        'name' => 'Weekly Top Views',
        'url' => '/popular?sort=week'
    ), array(
        'name' => 'Monthly Top Views',
        'url' => '/popular?sort=month'
    )
);

if ($posts->have_posts()): ?>
    <main>
        <article>
            <section id="popular">
                <?php mimi_sort_bars('Popular', $menu); ?>
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