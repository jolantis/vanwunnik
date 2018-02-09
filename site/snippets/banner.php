<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// PARTIAL
// ----------------------------------------------------------
////////////////////////////////////////////////////////// ?>

<header role="banner" id="page-top" class="banner compact-aligner contain-padding">

	<div class="masthead">
		<?php echo ($page->isHomePage()) ? '<h1>' : '<a href="' . $site->url() . '" title="Return to the homepage" rel="home">'; ?>
			<?php
				echo ($site->short_title()->isNotEmpty()) ? $site->short_title()->smartypants() : $site->title()->smartypants();
				echo ($site->short_title()->isNotEmpty() && $site->short_title_addendum()->isNotEmpty()) ? '<span class="is-hidden-visually">: ' . $site->short_title_addendum() . '</span>' : '';
			?>
		<?php echo ($page->isHomePage()) ? '</h1>' : '</a>'; ?>
	</div>

	<?php snippet('nav-main', array('loc' => 'header')); ?>
</header>
