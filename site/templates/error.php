<?php snippet('html-head', array(/* 'criticalcss' => 'other_than_default' */)); ?>

	<?php snippet('banner'); ?>

	<?php $error_image = $page->images()->shuffle()->first(); ?>

	<main class="hero bg-image bg-image--cover">

		<h1 class="is-hidden-visually">
			<?php echo ($page->long_title()->exists() && $page->long_title()->isNotEmpty()) ? $page->long_title()->smartypants()->widont() : $page->title()->smartypants()->widont(); ?>
		</h1>

		<?php echo $error_image->imageset('hero', ['output' => 'bgimage']); ?>
		<?php $work = $site->find('work'); ?>

		<span class="hero__text aligner aligner--stacked aligner--center">
			<span class="hero__title"><?php echo $page->hero_title()->smartypants()->widont(); ?></span>
			<?php if($page->hero_subtitle()->isNotEmpty()): ?>
				<span class="hero__subtitle"><?php echo $page->hero_subtitle()->smartypants(); ?></span>
			<?php endif; ?>
			<span class="hero__buttons aligner aligner--center">
				<a href="<?php echo $site->url(); ?>" class="button button--border-light icon icon--right">
					Go to homepage
					<svg role="presentation" width="24" height="24" title="Right arrow">
						<use xlink:href="/assets/images/sprite.svg#arrow-right"/>
					</svg>
				</a>
				<a href="<?php echo $site->find('work')->url(); ?>" class="hero__button button button--border-light icon icon--right">
					View work
					<svg role="presentation" width="24" height="24" title="Right arrow">
						<use xlink:href="/assets/images/sprite.svg#arrow-right"/>
					</svg>
				</a>
			</span>
		</span>
	</main>

	<?php snippet('contentinfo'); ?>

<?php snippet('html-foot'); ?>
