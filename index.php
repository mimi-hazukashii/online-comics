<?php get_header(); ?>
    <main>
        <article>
            <?php
            $posts = new WP_Query(array(
                'post_per_pages' => 6,
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'status',
                        'value' => 'upcoming',
                        'compare' => '!='
                    ), array(
                        'key' => 'mimi_post_views_count',
                        'value' => '0',
                        'compare' => '>=',
                        'type' => 'NUMERIC'
                    )
                )
            ));
            if ($posts->have_posts()): ?>
                <section id="recommend">
                    <?php mimi_title_bars(__('Recommend', 'mimi'), '/popular'); ?>
                    <div class="owl-carousel">
                        <?php
                        while ($posts->have_posts()):
                            $posts->the_post();
                            get_template_part('template-parts/post', 'carousel');
                        endwhile;
                        ?>
                    </div>
                </section>
            <?php endif;
            wp_reset_postdata(); ?>

            <?php
            $posts = new WP_Query(array(
                'post_per_pages' => 12,
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'status',
                        'value' => 'upcoming',
                        'compare' => '!='
                    ), array(
                        'key' => 'mimi_post_views_count',
                        'value' => '0',
                        'compare' => '>=',
                        'type' => 'NUMERIC'
                    )
                )
            ));
            if ($posts->have_posts()): ?>
                <section id="latest">
                    <?php mimi_title_bars(__('Latest', 'mimi'), '/all'); ?>
                    <div class="row">
                        <?php
                        while ($posts->have_posts()):
                            $posts->the_post();
                            get_template_part('template-parts/post');
                        endwhile;
                        ?>
                    </div>
                </section>
            <?php endif;
            wp_reset_postdata(); ?>

            <?php
            $posts = new WP_Query(array(
                'post_per_pages' => 6,
                'meta_query' => array(
                    array(
                        'key' => 'status',
                        'value' => 'upcoming'
                    )
                )
            ));
            if ($posts->have_posts()): ?>
                <section id="upcoming">
                    <?php mimi_title_bars(__('Upcoming', 'mimi'), '/upcoming'); ?>
                    <div class="owl-carousel">
                        <?php
                        while ($posts->have_posts()):
                            $posts->the_post();
                            get_template_part('template-parts/post', 'carousel');
                        endwhile;
                        ?>
                    </div>
                </section>
            <?php endif;
            wp_reset_postdata(); ?>
        </article>
    </main>
<?php get_footer();