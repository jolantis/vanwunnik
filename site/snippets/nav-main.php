<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////

$filter_key = (site()->language()->code() == 'nl' && $filter_key == 'series') ? 'serie' : $filter_key;

$location = isset($location) ? $location : false;

////////////////////////////////////////////////////////// ?>

<?php if($page->isHomePage()): ?>
	<?php if($location == 'header'): ?>
		<nav role="navigation" class="nav-main">
			<h2 class="is-hidden-visually"><?php echo l::get('main navigation'); ?></h2>
			<ul class="nav-main__list aligner aligner--wrap aligner--center">
	<?php else: ?>
		<?php if($location == 'footer'): ?>
			<div role="navigation" class="nav-main">
				<ul class="nav-main__list aligner aligner--wrap">
		<?php else: ?>
			<div role="navigation" class="nav-main">
				<ul class="nav-main__list">
		<?php endif; ?>
	<?php endif; ?>
<?php else: ?>
	<?php if($location == 'header'): ?>
		<div role="navigation" class="nav-main">
			<ul class="nav-main__list aligner aligner--wrap aligner--center">
	<?php else: ?>
		<?php if($location == 'footer'): ?>
			<nav role="navigation" class="nav-main">
				<h2 class="is-hidden-visually"><?php echo l::get('main navigation'); ?></h2>
				<ul class="nav-main__list aligner aligner--wrap">
		<?php else: ?>
			<div role="navigation" class="nav-main">
				<ul class="nav-main__list">
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>

		<?php if($location == 'footer'): ?>
			<li class="nav-main__item"><a rel="home" href="<?php echo $site->url(); ?>"<?php echo (page() == 'home' && !str::contains(kirby()->request()->path(), 'tag') && !str::contains(kirby()->request()->path(), 'werk')) ? ' aria-current="page"' : ''; ?>>Home</a></li>
		<?php endif; ?>

		<?php foreach($pages->visible()->not() as $page_item): ?>
			<?php /* if($filter_key && $filter_value && $page_item == 'blog' && ($site->url() . '/' . kirby()->request()->path() != site()->errorPage()->url())): */ ?>
			<?php if($filter_key && $filter_value && $page_item == 'werk' && ($site->url() . '/' . kirby()->request()->path() != site()->errorPage()->url())): ?>
				<li class="nav-main__item"><a href="<?php echo url($page_item->url() . '/' . (($filter_key == 'tags') ? 'tag' : $filter_key) . '/' . $filter_value); ?>"<?php echo (str::contains(kirby()->request()->path(), 'series') || str::contains(kirby()->request()->path(), 'serie')) ? ' aria-current="page"' : ''; ?>><?php echo $page_item->title()->smartypants(); ?></a></li>
			<?php else: ?>
				<li class="nav-main__item"><a href="<?php echo $page_item->url(); ?>"<?php echo ($page_item->isOpen() && ($page->depth() === 1)) ? ' aria-current="page"' : ''; ?>><?php echo $page_item->title()->smartypants(); ?></a></li>
			<?php endif; ?>
		<?php endforeach; ?>

<?php if(($page->isHomePage() && $location == 'header') || (!$page->isHomePage() && $location == 'footer')): ?>
		</ul>
	</nav>
<?php else: ?>
		</ul>
	</div>
<?php endif; ?>
