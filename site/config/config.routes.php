<?php

/* -----------------------------------------------------------------------------
Routes
--------------------------------------------------------------------------------

Additional route setup for Kirby's internal router.

*/

c::set('routes', array(

	/**
	 * Redirect `/sitemap` to `/sitemap.xml`
	 */
	array(
		'pattern' => 'sitemap',
		'action'  => function() {
			return go('sitemap.xml');
		}
	),

	/**
	 * Redirect `/target/pagina`, `/target/pagina/1` to /target and redirect `en/target/page`, and `en/target/page/1` to `en/target`
	 */
	array(
		'pattern' => array('(:any)/pagina', '(:any)/pagina/1'),
		'action'  => function($target) {

			$target_page = site()->visit($target);

			if(!$target_page) {
				return site()->visit(site()->errorPage());
			}
			else {
				return go($target_page, 404);
			}
		}
	),
	array(
		'pattern' => array('en/(:any)/page', 'en/(:any)/page/1'),
		'action'  => function($target) {

			$target_page = site()->visit($target, 'en');

			if(!$target_page) {
				return site()->visit(site()->errorPage(), 'en');
			}
			else {
				return go($target_page, 404);
			}
		}
	),

	/**
	* Archive pagination (e.g. /target/pagina/2, en/target/page/2, etc.)
	*/
	array(
		'pattern' => '(:any)/pagina/(:num)',
		'action'  => function($target, $page_num) {

			$args        = array('filter_key' => null, 'filter_value' => null, 'page_num' => $page_num);
			$target_page = site()->visit($target);

			if(!$target_page) {
				return site()->visit(site()->errorPage());
			}
			else {
				// return array($target, $args);
				return array($target_page, $args);
			}
		}
	),
	array(
		'pattern' => 'en/(:any)/page/(:num)',
		'action'  => function($target, $page_num) {

			$args        = array('filter_key' => null, 'filter_value' => null, 'page_num' => $page_num);
			$target_page = site()->visit($target, 'en');

			// Check if language code is part of the languages set in config
			// if(!in_array($lang_code, array_keys(get_object_vars(site()->languages())['data']))) $lang_active = 'nl';

			if(!$target_page) {
				return site()->visit(site()->errorPage(), 'en');
			}
			else {
				return array($target_page, $args);
			}
		}
	),

	/**
	* Catch English posts, before matching filtered archive pages in next route (e.g. en/target/post)
	*/
	array(
		'pattern' => 'en/(:any)/(:any)',
		'action'  => function($target, $post) {

			$target_page = site()->visit($target . '/' . $post, 'en');

			// var_dump($target_page);
			// site()->errorPage()

			if(!$target_page || $target_page == site()->errorPage()) {
				return site()->visit(site()->errorPage(), 'en');
			}
			else {
				return site()->visit($target . '/' . $post, 'en');
			}
		}
	),

	/**
	* Filter archive pages by filter-value (e.g. /target/filter-key/filter-value and en/target/filter-key/filter-value)
	*/
	array(
		'pattern' => '(:any)/(:any)/(:any)',
		'action'  => function($target, $filter_key, $filter_value) {

			$args        = array('filter_key' => $filter_key, 'filter_value' => $filter_value, 'page_num' => null);
			$page        = page($target . '/' . $filter_key . ':' . $filter_value);
			$target_page = site()->visit($target);

			if(!$target_page) {
				return site()->visit(site()->errorPage());
			}
			else {
				if($page) {
					// If page actually exists then return it
					return site()->visit($page->uri());
				} else {
					// Otherwise probably a filter-value
					return array($target_page, $args);
				}
			}
		}
	),
	array(
		'pattern' => 'en/(:any)/(:any)/(:any)',
		'action'  => function($target, $filter_key, $filter_value) {

			$args        = array('filter_key' => $filter_key, 'filter_value' => $filter_value, 'page_num' => null);
			$page        = page('en/' . $target . '/' . $filter_key . ':' . $filter_value);
			$target_page = site()->visit($target, 'en');

			if(!$target_page) {
				return site()->visit(site()->errorPage(), 'en');
			}
			else {
				if($page) {
					// If page actually exists then return it
					return site()->visit($page->uri());
				} else {
					// Otherwise probably a filter-value
					return array($target_page, $args);
				}
			}
		}
	),

	/**
	* Redirect `/target/filter-key/filter-value/pagina` to /targetfilter-key/filter-value/ and redirect `en/target/filter-key/filter-value/page` to `en/filter-key/filter-value/target`
	*/
	array(
		'pattern' => '(:any)/(:any)/(:any)/pagina',
		'action'  => function($target, $filter_key, $filter_value) {

			return go($target . '/' . $filter_key . '/' . $filter_value, 404);
		}
	),
	array(
		'pattern' => 'en/(:any)/(:any)/(:any)/page',
		'action'  => function($target, $filter_key, $filter_value) {

			return go('en/' . $target . '/' . $filter_key . '/' . $filter_value, 404);
		}
	),

	/**
	 * Filtered archive pages pagination (e.g. /target/filter-key/filter-value/pagina/2, and en/target/filter-key/filter-value/page/2, etc.)
	 */
	array(
		'pattern' => '(:any)/(:any)/(:any)/pagina/(:num)',
		'action'  => function($target, $filter_key, $filter_value, $page_num) {

			$args        = array('filter_key' => $filter_key, 'filter_value' => $filter_value, 'page_num' => $page_num);
			$target_page = site()->visit($target);

			if(!$target_page) {
				return site()->visit(site()->errorPage());
			}
			else {
				if($page_num == 1) {
					// Redirect `/target/filter-key/filter-value/pagina/1` to /targetfilter-key/filter-value/
					return go($target . '/' . $filter_key . '/' . $filter_value, 404);
				}
				else {
					return array($target_page, $args);
				}
			}
		}
	),
	array(
		'pattern' => 'en/(:any)/(:any)/(:any)/page/(:num)',
		'action'  => function($target, $filter_key, $filter_value, $page_num) {

			$args        = array('filter_key' => $filter_key, 'filter_value' => $filter_value, 'page_num' => $page_num);
			$target_page = site()->visit($target, 'en');

			if(!$target_page) {
				return site()->visit(site()->errorPage(), 'en');
			}
			else {
				if($page_num == 1) {
					// Redirect `/target/filter-key/filter-value/page/1` to /targetfilter-key/filter-value/
					return go('en/' . $target . '/' . $filter_key . '/' . $filter_value, 404);
				}
				else {
					return array($target_page, $args);
				}
			}
		}
	),

	// /**
	//  * Post items within filter-value (e.g. /target/filter-key/filter-value/post)
	//  */
	// array(
	// 	'pattern' => '((?!thumbs)[a-zA-Z0-9\.\-_%=]+)/(:any)/(:any)/(:any)',
	// 	'action'  => function($target, $filter_key, $filter_value, $post) {

	// 		$args        = array('filter_key' => $filter_key, 'filter_value' => $filter_value, 'page_num' => null);
	// 		$target_page = page($target);

	// 		if(isset($post)) {
	// 			$page = page($target . '/' . $post);
	// 			if(!$page) $page = go(site()->errorPage(), 404);
	// 			return array($target . '/'. $post, $args);
	// 		}

	// 		// If page actually exists then return it
	// 		if($page) return site()->visit($page->uri());

	// 		// Otherwise probably a filter-value
	// 		return array($target, $args);
	// 	}
	// ),

));
