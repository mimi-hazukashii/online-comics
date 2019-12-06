<?php get_header(); ?>
    <div id="content">
        <div class="container">
            <?php
            mimi_title_bar(__('Recommend', 'mimi'), '#');
            $posts = new WP_Query(array(
                'meta_query' => array(
                    array(
                        'key' => 'status',
                        'value' => 'complete'
                    )
                )
            ));
            ?>
            <div class="posts-area">
                <div class="owl-carousel">
                    <?php
                    if ($posts->have_posts()) {
                        while ($posts->have_posts()) {
                            $posts->the_post();
                            get_template_part('template-parts/carousel');
                        }
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <div class="container">
            <?php
            mimi_title_bar(__('Latest Update', 'mimi'), '#');
            $posts = new WP_Query(array(
                'meta_query' => array(
                    array(
                        'key' => 'status',
                        'value' => 'complete'
                    )
                )
            ));
            ?>
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
        </div>
        <div class="container">
            <?php
            mimi_title_bar(__('Upcoming', 'mimi'), '#');
            $posts = new WP_Query(array(
                'meta_query' => array(
                    array(
                        'key' => 'status',
                        'value' => 'complete'
                    )
                )
            ));
            ?>
            <div class="posts-area">
                <div class="owl-carousel">
                    <?php
                    if ($posts->have_posts()) {
                        while ($posts->have_posts()) {
                            $posts->the_post();
                            get_template_part('template-parts/carousel');
                        }
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>