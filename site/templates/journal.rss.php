<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// BLOG FEED
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////

// echo page('blog')->children()->visible()->flip()->limit(20)->feed(array(
echo page('dagboek')->children()->visible()->flip()->feed(array(
	'channel'       => 'dagboek',
	'textfield'     => 'description',
	'image'         => true,                                                   // Include image (after excerpt); first available image in folder is used (set to false when images are included in 'kirbytext' field, and excerpt is set to false, to prevent duplicate images!)
	'excerpt'       => true,
	'excerptlimit'  => 'words',                                                 // Limit excerpts by the number of 'words' (default) or 'characters'
	'excerptlenght' => 40,                                                      // Excerpt lenght in words or characters (depends on `excerptlimit` setting)
));

?>
