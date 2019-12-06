<?php for ($i = 0; $i < 4; ++$i): ?>
    <div class="item">
        <div class="wrap-post">
            <a href="<?php the_permalink(); ?>">
                <img class="owl-lazy" data-src="<?php the_field('thumbnail'); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                <h3 class="title"><?php the_title(); ?></h3>
            </a>
            <span class="views"><i class="fas fa-eye"></i> 6969</span>
        </div>
    </div>
<?php endfor; ?>