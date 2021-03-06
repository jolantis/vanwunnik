<?php
return function($site, $pages, $page, $args) {

	// First unset (remove) filter (key-value pair) cookies
	// If referer url does not contain 'dagboek' or 'journal'!
	if(!str::contains(kirby()->request()->referer(), 'dagboek') && !str::contains(kirby()->request()->referer(), 'journal')) {
		$filter_key   = false; cookie::remove('filter_key');
		$filter_value = false; cookie::remove('filter_value');
	}

	// Set defaults
	$page_num     = false;
	$pagination   = false;

	// Fetch key-value filter pair
	$lang_code    = (site()->language()->code() == 'en') ? '_en' : '';
	$filter_key   = (cookie::exists('filter_key' . $lang_code)) ? cookie::get('filter_key' . $lang_code) : false;
	$filter_value = (cookie::exists('filter_value' . $lang_code)) ? cookie::get('filter_value' . $lang_code) : false;

	// Fetch the basic set of pages
	// $page_items = ($filter_key && $filter_value) ? $page->siblings()->visible()->filterBy($filter_key, tagunslug($filter_value), ',') : $page->siblings()->visible();
	$page_items = $page->siblings()->visible();

	# Filter by date to exclude future posts (on production only)
	if(c::get('environment') != 'local' && c::get('environment') != 'stage') {
		$page_items = $page_items->filterBy('date', '<', time());
	}

	# Get translated posts only for current language
	$page_items = $page_items->translated();

	// Set next and prev (sibling) pages
	$prev = $page->prev_sibling($page_items);
	$next = $page->next_sibling($page_items);

	// // Go to error page
	// if($filter_key && $filter_value) {
	// 	if($page_items->count() == 0) go(site()->errorPage()->url(), 404);
	// }

	return compact('page_items', 'page_num', 'pagination', 'filter_key', 'filter_value', 'next', 'prev');

};
?>
