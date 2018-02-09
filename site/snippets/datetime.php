<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------
// Add a date field to your content file like this:
// Date: dd/mm/YYYY or Date: YYYY-mm-dd
// more info here: http://bit.ly/I9yabi and http://bit.ly/I9y4k6
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////

$date_format = (isset($format)) ? $format : 'Y-m-d';

////////////////////////////////////////////////////////// ?>

<?php if($page->date($format=true)): ?>
	<time datetime="<?php echo $page->date('c'); ?>" pubdate="Pubdate"><?php echo $date = (isset($relative) && $relative == true) ? relativeDate($page->date($date_format)) : $page->date($date_format); ?></time>
<?php else: ?>
	No (correct) date field defined in content file!
<?php endif; ?>
