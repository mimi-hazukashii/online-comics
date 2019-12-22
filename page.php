<?php
while (have_posts()): the_post();
    the_title();
    the_content();
    wp_reset_postdata();
endwhile;