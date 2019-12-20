<main>
	<article>
		<section id="read">
			<?php
			mimi_set_post_views();
			$chapters = get_field('chapters');
			$count_chapters = count($chapters);
			$current_chapter = get_query_var('mimi_chapter');
			$current_chapter_info = $prev_chapter = $next_chapter = null;
			$i = 0;
			while ($chapters[$i]['no'] !== $current_chapter)
				++$i;
			if ($i >= 0 && $i < $count_chapters) {
				$current_chapter_info = $chapters[$i];
				$prev_chapter = $chapters[$i - 1] ? $chapters[$i - 1]['no'] : null;
				$next_chapter = $chapters[$i + 1] ? $chapters[$i + 1]['no'] : null;
			}
			$current_server = $current_chapter_info['servers'][0];
			$chapter_images = explode(PHP_EOL, $current_server['chapter_images']); ?>
			<div class="chapter-info">
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - Chapter <?php echo $current_chapter; ?></h1>
				<p class="modified">Updated at: <?php echo $current_chapter_info['release_date']; ?></p>
			</div>
			<div class="row box">
				<div class="col-3 text-center">
					<a class="btn btn-sm btn-outline-info" href="<?php bloginfo('url'); ?>" title="Home Page"><i class="fas fa-home"></i></a>
					<a class="btn btn-sm btn-outline-info" href="<?php the_permalink(); ?>" title="View Info"><i class="fas fa-info-circle"></i></a>
				</div>
				<div class="col-6">
					<div class="form-inline justify-content-center">
						<?php if ($prev_chapter): ?>
							<a class="btn btn-sm btn-info px-2" href="<?php echo get_the_permalink() . "chapter-$prev_chapter"; ?>">
								<i class="fas fa-angle-left"></i>
							</a>
						<?php endif; ?>
						<select class="form-control form-control-sm w-50" id="switch-chapter">
							<?php foreach ($chapters as $chapter): ?>
								<option value="<?php echo get_the_permalink() . 'chapter-' . $chapter['no']; ?>"
									<?php if ($chapter['no'] === $current_chapter) echo 'selected'; ?>>
									Chapter <?php echo $chapter['no']; ?>
								</option>
							<?php endforeach; ?>
						</select>
						<?php if ($next_chapter): ?>
							<a class="btn btn-sm btn-info px-2" href="<?php echo get_the_permalink() . "chapter-$next_chapter"; ?>">
								<i class="fas fa-angle-right"></i>
							</a>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-3 text-center">
					<span class="btn btn-sm btn-outline-warning" title="Report"><i class="fas fa-bug"></i></span>
				</div>
			</div>
			<div class="pages">
				<?php foreach ($chapter_images as $image): ?>
					<div class="page">
						<img class="lazy" src="" data-src="<?php echo $image; ?>" alt="<?php echo get_the_title() . ' - Chapter ' . $current_chapter; ?>" title="<?php echo get_the_title() . ' - Chapter ' . $current_chapter; ?>">
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	</article>
</main>