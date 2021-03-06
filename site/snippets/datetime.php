<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------
// Add a date field to your content file like this:
// Date: dd/mm/YYYY or Date: YYYY-mm-dd
// more info here: http://bit.ly/I9yabi and http://bit.ly/I9y4k6
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////

// Set date time and format
$date_format = (isset($format)) ? $format : ((c::get('date.handler') == 'strftime') ? '%G-%m-%d' : 'Y-m-d');
$date_time   = (c::get('date.handler') == 'strftime') ? '%FT%T+00:00' : 'c';

////////////////////////////////////////////////////////// ?>

<?php if($page->date($format=true)): ?>
	<time datetime="<?php echo $page->date($date_time); ?>" pubdate="Pubdate"<?php echo ($page->date() > time() && (c::get('environment') == 'local' || c::get('environment') == 'stage')) ? ' class="text-mark"' : ''; ?>><?php echo $date = (isset($relative) && $relative == true) ? relativeDate($page->date($date_format)) : $page->date($date_format); ?></time>
<?php else: ?>
	<?php echo l::get('no date'); ?>
<?php endif; ?>
