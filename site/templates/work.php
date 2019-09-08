<?php snippet('html-head', array('criticalcss' => 'work')); ?>

	<?php snippet('banner'); ?>

	<main role="main" class="contain-padding">

		<h1 class="beta-heading is-hidden-visually">
			<?php echo ($page->long_title()->exists() && $page->long_title()->isNotEmpty()) ? $page->long_title()->smartypants()->widont() : $page->title()->smartypants()->widont(); ?>
		</h1>

		<?php $filter_key = (site()->language()->code() == 'nl') ? 'serie' : 'series'; ?>
		<?php snippet('filters', array('filter_key' => $filter_key, 'sort' => 'abc')); ?>
		<?php //snippet('filters'); ?>

		<section class="grid grid--gutter grid--align-bottom">
			<h2 class="is-hidden-visually">
				<?php echo l::get('work'); ?>
				<?php echo ($filter_value) ? '(&lsquo;' . tagunslug($filter_value) . '&rsquo; ' . l::get('tagged with') . ')' : ''; ?>
			</h2>
			<?php foreach ($page_items as $page_item) : ?>

				<?php /*
				<article class="grid__cell compact-1of2 large-1of3" id="<?php echo $page_item->slug(); ?>">
					<div class="grid grid--gutter">
						<div class="grid__cell medium-5of8">
							<figure class="figure-image">
								<?php echo $page_item->images()->first()->imageset('default'); ?>
							</figure>
						</div>

						<aside class="grid__cell medium-3of8">
							<h3>Title</h3>
						</aside>
					</div>
				</article>
				*/ ?>

				<article class="painting grid__cell compact-1of2 large-1of3 wide-1of4 huge-1of5" id="<?php echo $page_item->slug(); ?>">
					<a href="<?php echo $page_item->url() ?>" class="js-overlay-open">
						<figure class="figure-image">
							<?php echo $page_item->images()->first()->imageset('default'); ?>
						</figure>
						<div class="painting__info">
							<h3 class="epsilon-heading1"><?php echo $page_item->title()->smartypants(); ?></h3>
							<?php if($page_item->material_and_technique()->isNotEmpty()): ?>
								<p class="text-small">
									<span class="is-hidden-visually"><?php echo l::get('material and technique'); ?>: </span>
									<?php echo $page_item->material_and_technique()->smartypants(); ?>
								</p>
							<?php endif; ?>
							<?php if($page_item->measurements()->isNotEmpty()): ?>
								<p class="text-small">
									<span class="is-hidden-visually"><?php echo l::get('measurements'); ?>: </span>
									<?php echo $page_item->measurements()->html(); ?>
								</p>
							<?php endif; ?>
							<?php if($page_item->year()->isNotEmpty()): ?>
								<p class="text-small">
									<span class="is-hidden-visually"><?php echo l::get('year of painting'); ?>: </span>
									<?php echo $page_item->year()->html(); ?>
								</p>
							<?php endif; ?>
						</div>
					</a>
				</article>

			<?php endforeach; ?>
		</section>

	</main>

	<?php snippet('nav-pagination'); ?>

	<?php snippet('contentinfo'); ?>

	<div class="overlay is-hidden js-overlay" aria-hidden="true">
		<?php /*
		<div class="overlay__nav-left">
			<a class="js-overlay-open" data-target="#ajax-container" href="<?php //echo $prev ?>">Previous</a>
		</div>
		*/ ?>
		<div class="overlay__close">
			<?php if($filter_value): ?>
				<a href="<?php echo url($page->url() . '/' . (($filter_key == 'tags') ? 'tag' : $filter_key) . '/' . tagslug($filter_value) . (($page_num > 1) ? '/page/' . $page_num : '')); ?>" aria-label="<?php echo l::get('close overlay'); ?>" class="button button--simple icon js-overlay-close">
					<svg role="presentation">
						<title><?php echo l::get('cross title'); ?></title>
						<desc><?php echo l::get('cross desc'); ?></desc>
						<use xlink:href="/assets/images/sprite.svg#cross"/>
					</svg>
					<span class="is-hidden-visually"><?php echo l::get('close'); ?></span>
				</a>
			<?php else: ?>
				<a href="<?php echo $page->url() . (($page_num > 1) ? '/page/' . $page_num : ''); ?>" aria-label="<?php echo l::get('close overlay'); ?>" class="button button--simple icon icon--big js-overlay-close">
					<svg role="presentation">
						<title><?php echo l::get('cross title'); ?></title>
						<desc><?php echo l::get('cross desc'); ?></desc>
						<use xlink:href="/assets/images/sprite.svg#cross"/>
					</svg>
					<span class="is-hidden-visually"><?php echo l::get('close'); ?></span>
				</a>
			<?php endif; ?>
		</div>
		<div class="overlay__content" id="ajax-container"></div>
		<?php /*
		<div class="overlay__nav-right">
			<a class="js-overlay-open" data-target="#ajax-container" href="<?php //echo $next ?>">Next</a>
		</div>
		*/ ?>
	</div>

<?php snippet('html-foot'); ?>
