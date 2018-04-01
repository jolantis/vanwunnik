<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////

// Get (as passed `filter_items` variable) or otherwise fetch all (visible) page items
$page_items = (isset($filter_items)) ? $filter_items : $page->children()->visible();

// Fetch filter values (e.g. tags), seperated by comma, associated to blog posts
$filter_values = $page_items->pluck($filter_key, ',', true);

// Get (as passed `sort` variable) sort order ('count' or 'abc')
$sort = (isset($sort)) ? $sort : false;

// Sort all filter values (e.g. tags) by the number of instances of each filter value
if($sort == 'count') {
	usort($filter_values, function($a, $b) use($page_items, $filter_key) {
		$aCount = $page_items->filterBy($filter_key, $a, ',')->count();
		$bCount = $page_items->filterBy($filter_key, $b, ',')->count();
		return strcmp($bCount, $aCount);
	});
}

// Sort filter values (e.g. tags) alphabetical
if($sort == 'abc') {
	sort($filter_values);
}

////////////////////////////////////////////////////////// ?>

<?php if($filter_values): ?>
<div class="filters aligner">
	<h2 class="is-hidden-visually"><?php echo l::get('filter work'); ?></h2>
	<ul class="filterslist aligner js-filters">
		<?php if($filter_value): ?>
			<li class="filterslist__item">
				<a href="<?php echo $page->url(); ?>" class="button button--simple icon icon--right is-active" title="<?php echo l::get('remove filter'); ?>: &lsquo;<?php echo tagunslug($filter_value); ?>&rsquo;">
					<span class="is-hidden-visually"><?php echo l::get('remove filter'); ?>: </span>
					<?php echo tagunslug($filter_value); ?>
					<svg role="presentation">
						<title><?php echo l::get('cross title'); ?></title>
						<desc><?php echo l::get('cross desc'); ?></desc>
						<use xlink:href="/assets/images/sprite.svg#cross"/>
					</svg>
				</a>
			</li>
		<?php endif; ?>

		<?php foreach($filter_values as $filter_item): ?>

			<?php $page_items_count = $page_items->filterBy($filter_key, '==', tagunslug($filter_item), ',')->count(); // Associated number count of blog posts for the current filter value ?>

			<?php if(!$filter_value || $filter_value != tagslug($filter_item)): ?>
				<li class="filterslist__item">
					<a href="<?php echo url($page->url() . '/' . (($filter_key == 'tags') ? 'tag' : $filter_key) . '/' . tagslug($filter_item)) ?>" class="button button--simple" title="Add filter: &lsquo;<?php echo html($filter_item); ?>&rsquo;"><?php echo html($filter_item . ' <small class="filterslist__item-count">' . $page_items_count . '</small>'); ?></a>
				</li>
			<?php endif; ?>

		<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>
