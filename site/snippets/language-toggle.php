<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////

$location = isset($location) ? $location : false;

////////////////////////////////////////////////////////// ?>

<?php if($location == 'header'): ?>
	<?php if($page->isHomePage()): ?>
		<nav role="navigation" class="language-toggle">
			<h2 class="is-hidden-visually"><?php echo l::get('translations'); ?></h2>
	<?php else: ?>
		<div role="navigation" class="language-toggle">
	<?php endif; ?>
<?php else: ?>
	<?php if($location == 'footer'): ?>
		<nav role="navigation">
			<h2 class="is-hidden-visually"><?php echo l::get('change language'); ?></h2>
	<?php else: ?>
		<div role="navigation" class="nav-main">
	<?php endif; ?>
<?php endif; ?>

	<?php if($location == 'footer'): ?>

		<?php foreach($site->languages() as $language): ?>
			<?php if($site->language()->code() != $language): ?>
				<p>
					<?php echo l::get('change language to'); ?>
					<a rel="alternate" href="<?php echo ($page->content($language->code())->language() != $site->language($language->code())) ? page('error')->url($language->code()) : $page->url($language->code()); ?>" hreflang="<?php echo $language ?>" class="button button--simple"><?php echo $language->name(); ?></a>
				</p>
			<?php endif; ?>
		<?php endforeach; ?>

	<?php else: ?>

		<ul class="aligner aligner--right">
			<?php foreach($site->languages()->flip() as $language): ?>
				<li class="language-toggle__item">
					<a rel="alternate" href="<?php echo ($page->content($language->code())->language() != $site->language($language->code())) ? page('error')->url($language->code()) : $page->url($language->code()); ?>" hreflang="<?php echo $language ?>"<?php echo ($site->language() == $language) ? ' aria-current="true"' : ''; ?> aria-label="<?php echo $language->name(); ?>"><?php echo $language->code(); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>

	<?php endif; ?>

<?php if(($location == 'header' && $page->isHomePage()) || $location == 'footer'): ?>
	</nav>
<?php else: ?>
	</div>
<?php endif; ?>
