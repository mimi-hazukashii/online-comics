<?php get_header(); ?>
    <div id="content">
        <div class="container">
            <?php
            $posts = new WP_Query(array(
                'meta_query' => array(
                    array(
                        'key' => 'status',
                        'value' => 'upcoming',
                        'compare' => '!='
                    )
                )
            ));
            if ($posts->have_posts()) {
                mimi_title_bar(__('Recommend', 'mimi'), '/popular'); ?>
                <div class="owl-carousel">
                    <?php
                    while ($posts->have_posts()) {
                        $posts->the_post();
                        get_template_part('template-parts/carousel');
                    }
                    ?>
                </div>
            <?php }
            wp_reset_postdata(); ?>
        </div>
        <div class="container">
            <?php
            $posts = new WP_Query(array(
                'meta_query' => array(
                    array(
                        'key' => 'status',
                        'value' => 'upcoming',
                        'compare' => '!='
                    )
                )
            ));
            if ($posts->have_posts()) {
                mimi_title_bar(__('Latest Update', 'mimi'), '/all'); ?>
                <div class="row">
                    <?php
                    while ($posts->have_posts()) {
                        $posts->the_post();
                        get_template_part('template-parts/content');
                    }
                    ?>
                </div>
            <?php }
            wp_reset_postdata(); ?>
        </div>
        <div class="container">
            <?php
            $posts = new WP_Query(array(
                'meta_query' => array(
                    array(
                        'key' => 'status',
                        'value' => 'upcoming'
                    )
                )
            ));
            if ($posts->have_posts()) {
                mimi_title_bar(__('Upcoming', 'mimi'), '/upcoming'); ?>
                <div class="owl-carousel">
                    <?php
                    while ($posts->have_posts()) {
                        $posts->the_post();
                        get_template_part('template-parts/carousel');
                    }
                    ?>
                </div>
            <?php }
            wp_reset_postdata(); ?>
        </div>
    </div>
<?php get_footer(); ?>