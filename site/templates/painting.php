<?php if(kirby()->request()->ajax()): ?>

	<?php $kirby->set('option', 'imageset.ratio', false); ?>

	<?php foreach($page->images()->shuffle()->limit(1) as $image): ?>
		<?php $caption = ($image->caption()->isNotEmpty()) ? $image->caption() : ''; ?>
		<figure class="overlay-image">
			<?php echo $image->imageset('default', ['output' => 'overlay']); ?>
			<?php if($caption): ?>
				<figcaption><?php echo $caption->smartypants(); ?></figcaption>
			<?php endif; ?>
		</figure>
	<?php endforeach; ?>

<?php else: ?>

	<?php snippet('html-head', array('criticalcss' => 'work_item')); ?>

		<?php snippet('banner'); ?>

		<main role="main" class="copy copy--contain">

			<h1>
				<?php echo ($page->long_title()->exists() && $page->long_title()->isNotEmpty()) ? $page->long_title()->smartypants()->widont() . ' <i>(' . $page->year() . ')</i>' : $page->title()->smartypants()->widont() . ' <i>(' . $page->year() . ')</i>'; ?>
			</h1>

			<?php foreach($page->images()->limit(1) as $image): ?>
				<?php $caption = ($image->caption()->isNotEmpty()) ? $image->caption() : ''; ?>
				<figure class="figure-image">
					<?php echo $image->imageset('default'); ?>
					<?php if($caption): ?>
						<figcaption><?php echo $caption->smartypants(); ?></figcaption>
					<?php endif; ?>
				</figure>
			<?php endforeach; ?>

			<?php if($page->material_and_technique()->isNotEmpty()): ?>
				<p class="text-no-intro">
					<span><?php echo l::get('material and technique'); ?>: </span>
					<?php echo $page->material_and_technique()->smartypants(); ?>
				</p>
			<?php endif; ?>
			<?php if($page->measurements()->isNotEmpty()): ?>
				<p>
					<span><?php echo l::get('measurements'); ?>: </span>
					<?php echo $page->measurements(); ?>
				</p>
			<?php endif; ?>
			<?php if($page->year()->isNotEmpty()): ?>
				<p>
					<span><?php echo l::get('year of painting'); ?>: </span>
					<?php echo $page->year(); ?>
				</p>
			<?php endif; ?>
		</main>

	<?php snippet('contentinfo'); ?>

<?php endif; ?>
