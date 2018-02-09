<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// BLOG FEED
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////

// echo page('blog')->children()->visible()->flip()->limit(20)->feed(array(
echo page('journal')->children()->visible()->flip()->feed(array(
	'channel'       => 'journal',
	'textfield'     => 'text',
	'image'         => false,                                                   // Include image (after excerpt); first available image in folder is used (set to false when images are included in 'kirbytext' field, and excerpt is set to false, to prevent duplicate images!)
	'excerpt'       => false,
	'excerptlimit'  => 'words',                                                 // Limit excerpts by the number of 'words' (default) or 'characters'
	'excerptlenght' => 40,                                                      // Excerpt lenght in words or characters (depends on `excerptlimit` setting)
));

?>
