<?php snippet('html-head', array('criticalcss' => 'info')); ?>

	<?php snippet('banner'); ?>

	<main role="main" class="copy copy--contain">

		<h1>
			<?php echo ($page->long_title()->exists() && $page->long_title()->isNotEmpty()) ? $page->long_title()->smartypants()->widont() : $page->title()->smartypants()->widont(); ?>
		</h1>

		<?php if($page->intro()->isNotEmpty()): ?>
			<?php echo $page->intro()->kirbytext(); ?>
		<?php endif; ?>

		<?php echo $page->text()->kirbytext(); ?>

	</main>

	<?php snippet('contentinfo'); ?>

<?php snippet('html-foot'); ?>
