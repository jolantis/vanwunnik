<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------
////////////////////////////////////////////////////////// ?>

<ul>
<?php foreach($site->languages() as $language): ?>
	<li<?php echo ($site->language() == $language) ? ' class="active"' : ''; ?>>
		<a href="<?php echo ($page->content($language->code())->language() != $site->language($language->code())) ? page('error')->url($language->code()) : $page->url($language->code()); ?>"><?php echo $language->code(); ?></a>
	</li>
<?php endforeach; ?>
</ul>
