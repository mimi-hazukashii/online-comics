<?php
$posts = new WP_Query(array(
    'posts_per_page' => 4,
    'meta_query' => array(
        array(
            'key' => 'status',
            'value' => 'upcoming',
            'compare' => '!='
        )
    )
));
if ($posts->have_posts()):
    while ($posts->have_posts()):
        $posts->the_post(); ?>
        <div class="col-lg-12 col-md-6">
            <div class="wrap-sidebar">
                <div class="row">
                    <div class="col-5 pr-0">
                        <a href="<?php the_permalink(); ?>">
                            <img class="lazy" src="" data-src="<?php the_field('thumbnail'); ?>"
                                 alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                        </a>
                    </div>
                    <div class="col-7 pl-2">
                        <h2><?php the_title(); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile;
endif;
wp_reset_postdata();