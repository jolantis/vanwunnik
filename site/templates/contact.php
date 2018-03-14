<?php snippet('html-head', array('criticalcss' => 'contact')); ?>

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

	<?php /*
	<div role="contentinfo" class="contentinfo">

		<?php // snippet('nav-main', array('location' => 'footer')); ?>

		<footer class="medium-aligner contain-padding">
			<p>&copy; <?php echo '2007&ndash;' . date("Y"); ?> <a href="https://vanwunnik.com" rel="me"><?php echo $site->copyright()->smartypants(); ?></a></p>
			<p class="medium-aligner__item--right">All contents licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" title="Creative Commons Attribution-Non-Commercial-No-Derivs 4.0 International">CC BY-NC-ND license</a></p>
		</footer>
	</div>
	*/ ?>

<?php snippet('html-foot'); ?>
