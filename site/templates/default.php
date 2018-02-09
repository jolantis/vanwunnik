<?php snippet('html-head', array(/* 'criticalcss' => 'other_than_default' */)); ?>

	<?php snippet('banner'); ?>

	<main role="main" class="copy copy--contain">

		<h1>
			<?php echo ($page->long_title()->exists() && $page->long_title()->isNotEmpty()) ? $page->long_title()->smartypants()->widont() : $page->title()->smartypants()->widont(); ?>
		</h1>

		<?php if($page->intro()->isNotEmpty()): ?>
			<?php echo $page->intro()->kirbytext(); ?>
		<?php endif; ?>

		<?php echo $page->text()->kirbytext(); ?>

		<?php if($page->hasImages()): ?>

			<?php foreach($page->images()->shuffle()->limit(1) as $image): ?>
				<?php $caption = ($image->caption()->isNotEmpty()) ? $image->caption() : ''; ?>
				<figure class="figure-image">
					<?php echo $image->imageset('default'); ?>
					<?php if($caption): ?>
						<figcaption><?php echo $caption->smartypants(); ?></figcaption>
					<?php endif; ?>
				</figure>
			<?php endforeach; ?>

		<?php endif; ?>

	</main>

	<?php snippet('contentinfo'); ?>

<?php snippet('html-foot'); ?>
