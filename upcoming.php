<?php
/*
 * Template Name: Upcoming
 */

get_header();

$args = array(
    'post_per_pages' => get_option('post_per_pages'),
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    'meta_query' => array(
        array(
            'key' => 'status',
            'value' => 'upcoming'
        )
    )
);

if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
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
        'name' => 'Title ASC',
        'url' => '/upcoming?sort=asc'
    ), array(
        'name' => 'Title DESC',
        'url' => '/upcoming?sort=desc'
    )
);

if ($posts->have_posts()): ?>
    <main>
        <article>
            <section id="upcoming">
                <?php mimi_sort_bars('Upcoming', $menu); ?>
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