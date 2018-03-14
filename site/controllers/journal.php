<?php
return function($site, $pages, $page, $args) {

	// Set defaults
	$page_num            = (isset($args['page_num'])) ? ($args['page_num']) : 1;
	$pagination          = (c::get('pagination.' . $page->intendedTemplate()) == false) ? false : true;
	// $pagination_filtered = (c::get('pagination.filtered') == true) ? true : false;

	// Fetch key-value filter pair
	$lang_code    = (site()->language()->code() == 'en') ? '_en' : '';
	$filter_key   = (cookie::exists('filter_key' . $lang_code)) ? cookie::get('filter_key' . $lang_code) : false;
	$filter_value = (cookie::exists('filter_value' . $lang_code)) ? cookie::get('filter_value' . $lang_code) : false;

	// Fetch the basic set of pages
	$page_items          = $page->children()->visible()->flip();

	# If pagination
	if($pagination) {
		$page_items = $page_items->paginate(c::get('pagination.' . $page->intendedTemplate(), 10), array('page' => $page_num));
	}
	# If no pagination
	else {
		$pagination = false;
	}

	# Filter by date to exclude future posts
	$page_items = $page_items->filterBy('date', '<', time());

	# Set pagination
	$pagination = $page_items->pagination();

	return compact('page_items', 'page_num', 'pagination', 'filter_key', 'filter_value');

};
?>
