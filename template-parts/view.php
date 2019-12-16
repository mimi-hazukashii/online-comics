<main>
	<article>
		<div class="row">
			<div class="col-lg-9 pr-4">
				<section id="info">
					<?php
					while (have_posts()): the_post(); ?>
						<div class="row">
							<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6" style="position: relative;">
								<img class="lazy" src="" data-src="<?php echo mimi_get_post_thumbnail(); ?>"
								     alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
								<span class="views"><i class="fas fa-eye"></i> <?php echo mimi_get_post_views(); ?></span>
							</div>
							<div class="col-xl-9 col-lg-8 col-md-8 col-sm-6">
								<h1><?php the_title(); ?></h1>
								<?php if (get_field('sub_title')): ?>
									<div class="post-info">
										<strong>Sub Title:</strong> <?php the_field('sub_title'); ?>
									</div>
								<?php endif; ?>
								<div class="post-info">
									<strong>Categories:</strong> <?php the_category(', '); ?>
								</div>
								<div class="post-info">
									<strong>Author:</strong>
									<?php
									if (get_the_terms(get_the_ID(), 'authors'))
										the_terms(get_the_ID(), 'authors', '', ', ', '');
									else echo 'Updating...';
									?>
								</div>
								<div class="post-info">
									<strong>Source:</strong>
									<?php
									if (get_field('source'))
										the_field('source');
									else bloginfo('name');
									?>
								</div>
								<div class="post-info">
									<strong>Status:</strong> <?php echo ucfirst(get_field('status')); ?>
								</div>
							</div>
						</div>
						<div class="description my-3">
							<?php the_content(); ?>
						</div>
					<?php endwhile;
					wp_reset_postdata();
					$chapters = get_field('chapters'); ?>
				</section>
				<?php if (!empty($chapters)): ?>
					<section id="chapters">
						<h2>Chapters</h2>
						<div class="list-chapters">
							<?php foreach ($chapters as $chapter):
								if ($chapter['is_publish'][0] === 'publish'): ?>
									<div class="chapter">
										<div class="row">
											<div class="col-8">
												<a href="chapter-<?php echo $chapter['no']; ?>">Chapter <?php echo $chapter['no']; ?></a>
												<?php if ($chapter['is_new'][0] === 'new') echo '<span class="new">(NEW)</span>'; ?>
											</div>
											<div class="col-4 release"><?php echo $chapter['release_date']; ?></div>
										</div>
									</div>
								<?php endif;
							endforeach; ?>
						</div>
					</section>
				<?php endif; ?>
			</div>
			<div class="col-lg-3">
				<aside id="sidebar">
					<div class="row">

					</div>
				</aside>
			</div>
		</div>
	</article>
</main>