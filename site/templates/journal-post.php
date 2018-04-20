<?php snippet('html-head', array('criticalcss' => 'journal_post')); ?>

	<?php snippet('banner'); ?>

	<?php $main_image = ($page->images()->filterBy('filename','*=','main')->first()) ? $page->images()->filterBy('filename','*=','main')->first() : $page->images()->sortBy('sort', 'asc')->first(); ?>

	<?php if(!$page->content($page->content()->language())->exists()): ?>

		<main role="main" class="hero bg-image bg-image--cover">
			<?php echo $main_image->imageset('hero', ['output' => 'bgimage']); ?>
			<span class="hero__text aligner aligner--stacked aligner--center">
				<h1 class="hero__title">Not yet translated</h1>
				<span class="hero__subtitle">
					Please return when &lsquo;<a href="<?php echo $page->url(); ?>"><?php echo $page->title()->smartypants()->widont(); ?></a>&rsquo; is translated.
				</span>
				<span class="hero__button aligner aligner--center">
					<a href="<?php echo $page->url(); ?>" class="hero__button button button--border-light icon icon--right">
						Return to Dutch version
						<svg role="presentation" width="24" height="24" title="Right arrow">
							<use xlink:href="/assets/images/sprite.svg#arrow-right"/>
						</svg>
					</a>
					<a href="<?php echo $site->find('dagboek')->url('en'); ?>" class="button button--border-light icon icon--right">
						Go to journal overview
						<svg role="presentation" width="24" height="24" title="Right arrow">
							<use xlink:href="/assets/images/sprite.svg#arrow-right"/>
						</svg>
					</a>
				</span>
			</span>
		</main>

	<?php else: ?>

		<div class="hero bg-image bg-image--cover">
			<?php echo $main_image->imageset('hero', ['output' => 'bgimage']); ?>
			<span class="hero__text aligner aligner--stacked aligner--center">
				<span class="hero__title"><?php echo $page->title()->smartypants()->widont(); ?></span>
				<?php /*
				<span class="hero__subtitle">
					<?php if($page->tags()->isNotEmpty()): ?>
						<?php $i = 0; foreach($tags = str::split($page->tags(),',') as $tag): ?>
							<?php echo $tag; ?><?php if($i < (count($tags) -1)): echo ' &mdash; '; endif; ?>
						<?php $i++; endforeach; ?>
				<?php endif; ?>
				</span>
				*/ ?>
				<span class="hero__meta">
					<a href="#start">
						<?php /* <?php echo $page->images()->count(); ?> photos</span> */ ?>
						<?php if($page->date($format=true)): ?>
							<?php snippet('datetime', ['format' => '%e %B %Y']); ?>
						<?php endif; ?>
					</a>
				</span>
			</span>
		</div>

		<main role="main" class="copy copy--contain space-leader-xl">

			<h1 id="start">
				<?php echo ($page->long_title()->exists() && $page->long_title()->isNotEmpty()) ? $page->long_title()->smartypants()->widont() : $page->title()->smartypants()->widont(); ?>
			</h1>

			<?php if($page->tags()->isNotEmpty() || $page->date($format=true)): ?>
				<div class="post-meta">

				<?php if($page->tags()->isNotEmpty()): ?>
					<?php echo l::get('posted in'); ?>
					<?php $i = 1; foreach($tags = str::split($page->tags(),',') as $tag): ?>
						<a href="<?php echo $page->parent()->url() . '/tags/' . tagslug($tag); ?>" class="link link--no-history"><?php echo $tag; ?></a>
						<?php
							if($i == (count($tags) - 1)):
								echo ' and ';
							elseif($i < (count($tags))):
								echo ', ';
							endif;
						?>
					<?php $i++; endforeach; ?>

					<?php if($page->date($format=true)): ?>
						<?php echo l::get('on'); snippet('datetime', ['format' => '%e %B %Y']); ?>
					<?php endif; ?>

				<?php else: ?>

					<?php if($page->date($format=true)): ?>
						<?php echo l::get('posted on'); snippet('datetime', ['format' => '%e %B %Y']); ?>
					<?php endif; ?>

				<?php endif; ?>

				</div>
			<?php endif; ?>

			<?php if($page->intro()->isNotEmpty()): ?>
				<?php echo $page->intro()->kirbytext(); ?>
			<?php endif; ?>

			<?php if($page->text()->isNotEmpty()): ?>

				<?php echo $page->text()->kirbytext(); ?>

			<?php else: ?>

				<?php /* foreach ($page->images()->sortBy('sort', 'asc')->not($main_image) as $image): */ ?>
				<?php foreach ($page->images()->filterBy('filename','!*=','main')->sortBy('sort', 'asc') as $image) : ?>
					<figure class="figure-image">
						<?php echo $image->imageset('default'); ?>
						<?php if($image->caption()->isNotEmpty()): ?>
							<figcaption><?php echo $image->caption()->smartypants(); ?></figcaption>
						<?php endif; ?>
					</figure>
				<?php endforeach; ?>

			<?php endif; ?>

		</main>

		<?php /*
		<div class="contain-padding space-leader-m">
			<?php if($filter_value): ?>
				<?php $blog_posts_count = $page->parent()->children()->visible()->filterBy($filter_key, '==', tagunslug($filter_value), ',')->count(); // Associated number count of blog posts for the current filter value ?>
				<p>
					<a href="<?php echo $page->parent()->url(); ?>" class="button button--simple icon icon--right is-active" title="<?php echo l::get('remove filter'); ?>: &lsquo;<?php echo tagunslug($filter_value); ?>&rsquo;">
						<span class="is-hidden-visually"><?php echo l::get('remove filter'); ?>: </span>
						<?php echo tagunslug($filter_value); ?>
						<svg role="presentation" title="Cross">
							<use xlink:href="/assets/images/sprite.svg#cross"/>
						</svg>
					</a>
					<small>active filter with <a href="<?php echo $page->parent()->url() . '/tags/' . tagslug($filter_value); ?>" class="link link--no-history"><?php echo ($blog_posts_count < 2) ? $blog_posts_count . ' post' : $blog_posts_count . ' posts'; ?></a></small>
				</p>
			<?php endif; ?>
		</div>
		*/ ?>

		<?php snippet('nav-prevnext'); ?>

	<?php endif; ?>

	<?php snippet('contentinfo'); ?>

<?php snippet('html-foot'); ?>
