<?php
while (have_posts()):
    the_post();
    $chapters = get_field('chapters');
    $count_chapters = count($chapters);
    $current_chapter = get_query_var('mimi_chapter');
    $chapter_data = $chapters[$count_chapters - $current_chapter];
    if (!$chapter_data)
        $chapter_data = $chapters[0];
    $links = explode(PHP_EOL, $chapter_data['links']); ?>
    <div id="chapter-content">
        <div class="container">
            <div class="info-box">
                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - Chapter <?php echo $current_chapter; ?></h1>
            </div>
            <div class="read-box">
                <?php foreach ($links as $link): ?>
                    <img class="lazy" src="" data-src="<?php echo $link; ?>"
                         alt="Chapter <?php echo $current_chapter; ?> - <?php the_title() ?>"
                         title="Chapter <?php echo $current_chapter; ?> - <?php the_title() ?>">
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endwhile;
wp_reset_postdata();