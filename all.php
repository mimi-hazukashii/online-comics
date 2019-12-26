<?php
/*
 * Template Name: All
 */

get_header();

$args = array(
    'post_per_pages' => get_option('post_per_pages'),
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
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
        case 'views':
            $args['order'] = 'DESC';
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'mimi_post_views_count';
            break;
        case 'asc':
            $args['order'] = 'ASC';
            $args['orderby'] = 'title';
            break;
        case 'desc':
            $args['order'] = 'DESC';
            $args['orderby'] = 'title';
            break;
        default:
            $args['order'] = 'DESC';
            $args['orderby'] = 'date';
    }
}

$posts = new WP_Query($args);

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