<?php for ($i = 0; $i < 24; ++$i): ?>
    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
        <div class="wrap-post">
            <a href="<?php the_permalink(); ?>">
                <img class="lazy" data-src="<?php the_field('thumbnail'); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                <h3 class="title"><?php the_title(); ?></h3>
            </a>
            <span class="views"><i class="fas fa-eye"></i> 6969</span>
        </div>
    </div>
<?php endfor; ?>