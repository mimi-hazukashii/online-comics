<div id="post-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 pr-4">
                <?php
                mimi_set_post_views(get_the_ID());
                while (have_posts()):
                    the_post(); ?>
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 relative">
                            <img class="lazy" src="" data-src="<?php the_field('thumbnail'); ?>"
                                 alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                            <span class="views"><i class="fas fa-eye"></i> <?php echo mimi_get_post_views(get_the_ID()); ?></span>
                        </div>
                        <div class="col-xl-9 col-lg-8 col-md-8 col-sm-6">
                            <h1><?php the_title(); ?></h1>
                            <div class="post-info">
                                <strong>Sub Title:</strong> <?php the_field('sub_title'); ?>
                            </div>
                            <div class="post-info">
                                <strong>Categories:</strong> <?php the_category(', '); ?>
                            </div>
                            <div class="post-info">
                                <strong>Author:</strong> <?php the_terms(get_the_ID(), 'author', '', ', ', ''); ?>
                            </div>
                            <div class="post-info">
                                <strong>Source:</strong> <?php the_field('source'); ?>
                            </div>
                            <div class="post-info">
                                <strong>Status:</strong> <?php echo ucfirst(get_field('status')); ?>
                            </div>
                            <div class="post-info">
                                <strong>Tags:</strong> <?php the_tags('', ', ', ''); ?>
                            </div>
                        </div>
                    </div>
                    <div class="description my-3">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
                $chapters = get_field('chapters');
                if ($chapters): ?>
                    <h3>Chapters</h3>
                    <div class="chapters">
                        <?php foreach ($chapters as $chapter): $chapter = $chapter['meta']; ?>
                            <div class="chapter">
                                <div class="row">
                                    <div class="col-8">
                                        <a href="chapter-<?php echo $chapter['no']; ?>">Chapter <?php echo $chapter['no']; ?></a>
                                        <?php if ($chapter['new'][0] === 'new'): ?>
                                            <span class="new">(NEW)</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-4 modified"><?php echo $chapter['date']; ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-3">
                <div class="sidebar">
                    <div class="row">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>