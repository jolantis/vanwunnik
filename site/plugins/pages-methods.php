<?php

/**
 * Custom pages methods
 *
 * @author      Jonathan van Wunnik <jonathan@artlantis.nl>
 *
 * @license     Code and contributions have 'MIT License'
 *
 * @link        https://getkirby.com/docs/developer-guide/objects/pages
 *
 */

/**
 * Get translated pages (content) only
 *
 * Usage example:
 * `foreach($pages->translated() as $page): …`
 */

pages::$methods['translated'] = function($pages) {
	return $pages->filter(function($page) {
		return $page->content(site()->language()->code())->exists();
	});
};

?>
