<?php
$posts = new WP_Query(array(
    'meta_query' => array(
        array(
            'key' => 'status',
            'value' => 'complete'
        )
    )
));
if ($posts->have_posts()) {
    while ($posts->have_posts()) {
        $posts->the_post(); ?>
        <?php for ($i = 0; $i < 5; ++$i): ?>
        <div class="wrap-sidebar">
            <div class="row">
                <div class="col-5 pr-0">
                    <a href="<?php the_permalink(); ?>">
                        <img class="lazy" data-src="<?php the_field('thumbnail'); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                    </a>
                </div>
                <div class="col-7 pl-2">
                    <h2><?php the_title(); ?></h2>
                </div>
            </div>
        </div>
        <?php endfor; ?>
    <?php }
}
wp_reset_postdata();