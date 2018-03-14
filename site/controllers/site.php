<?php
return function($site, $pages, $page, $args) {

	// Set defaults
	$page_num     = false;
	$pagination   = false;

	// Fetch key-value filter pair
	$lang_code    = (site()->language()->code() == 'en') ? '_en' : '';
	$filter_key   = (cookie::exists('filter_key' . $lang_code)) ? cookie::get('filter_key' . $lang_code) : false;
	$filter_value = (cookie::exists('filter_value' . $lang_code)) ? cookie::get('filter_value' . $lang_code) : false;

	return compact('page_num', 'pagination', 'filter_key', 'filter_value');

};
?>
