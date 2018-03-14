<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------

$filter_key = (site()->language()->code() == 'nl' && $filter_key == 'series') ? 'serie' : $filter_key;

$location = isset($location) ? $location : false;

////////////////////////////////////////////////////////// ?>

<?php if($page->isHomePage()): ?>
	<?php if($location == 'header'): ?>
		<nav role="navigation" class="nav-main compact-aligner__item--right">
			<h2 class="is-hidden-visually">Main navigation</h2>
			<ul class="nav-main__list aligner aligner--wrap aligner--center">
	<?php else: ?>
		<?php if($location == 'footer'): ?>
			<div class="nav-main contain-padding">
				<ul class="nav-main__list aligner aligner--wrap">
		<?php else: ?>
			<div class="nav-main">
				<ul class="nav-main__list">
		<?php endif; ?>
	<?php endif; ?>
<?php else: ?>
	<?php if($location == 'header'): ?>
		<div class="nav-main compact-aligner__item--right">
			<ul class="nav-main__list aligner aligner--wrap aligner--center">
	<?php else: ?>
		<?php if($location == 'footer'): ?>
			<nav role="navigation" class="nav-main contain-padding">
				<h2 class="is-hidden-visually">Main navigation</h2>
				<ul class="nav-main__list aligner aligner--wrap">
		<?php else: ?>
			<div class="nav-main">
				<ul class="nav-main__list">
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>

		<?php if($location == 'footer'): ?>
			<li class="nav-main__item"<?php echo (page() == 'home' && !str::contains(kirby()->request()->path(), 'tag') && !str::contains(kirby()->request()->path(), 'werk')) ? ' aria-current="page"' : ''; ?>><a rel="home" href="<?php echo $site->url(); ?>">Home</a></li>
		<?php endif; ?>

		<?php foreach($pages->visible()->not() as $page_item): ?>
			<?php /* if($filter_key && $filter_value && $page_item == 'blog' && ($site->url() . '/' . kirby()->request()->path() != site()->errorPage()->url())): */ ?>
			<?php if($filter_key && $filter_value && $page_item == 'werk' && ($site->url() . '/' . kirby()->request()->path() != site()->errorPage()->url())): ?>
				<li class="nav-main__item"<?php echo (str::contains(kirby()->request()->path(), 'series')) ? ' aria-current="page"' : ''; ?>><a href="<?php echo url($page_item->url() . '/' . (($filter_key == 'tags') ? 'tag' : $filter_key) . '/' . $filter_value); ?>"><?php echo $page_item->title()->smartypants(); ?></a></li>
			<?php else: ?>
				<li class="nav-main__item"<?php echo ($page_item->isOpen() && !kirby()->request()->path()->nth(1)) ? ' aria-current="page"' : ''; ?>><a href="<?php echo $page_item->url(); ?>"><?php echo $page_item->title()->smartypants(); ?></a></li>
			<?php endif; ?>
		<?php endforeach; ?>

<?php if(($page->isHomePage() && $location == 'header') || (!$page->isHomePage() && $location == 'footer')): ?>
		</ul>
	</nav>
<?php else: ?>
		</ul>
	</div>
<?php endif; ?>
