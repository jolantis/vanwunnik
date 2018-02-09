<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------
////////////////////////////////////////////////////////// ?>

<div vocab="http://schema.org/" typeof="Person" class="vcard">
	<?php if($page->company()->isNotEmpty()): ?><span property="name" class="is-hidden-visually"><?php echo $page->company()->smartypants(); ?></span><?php endif; ?>
	<?php if($page->name()->isNotEmpty()): ?><span property="name"><?php echo $page->name()->smartypants(); ?></span><?php endif; ?>
	<?php if($page->gravatar()->isNotEmpty()): ?><img src="https://gravatar.com/avatar/<?php echo $page->gravatar()->html(); ?>" property="image" alt="Avatar of <?php echo $page->name()->smartypants(); ?>" class="is-hidden-visually"><?php endif; ?>
	<?php if($page->job_title()->isNotEmpty()): ?><span property="jobTitle" class="is-hidden-visually"><?php echo $page->job_title()->smartypants(); ?></span><?php endif; ?><br>
	<?php if($page->company()->isNotEmpty() || $page->zip()->isNotEmpty() || $page->city()->isNotEmpty() || $page->country()->isNotEmpty()): ?>
	<span property="address" typeof="PostalAddress">
			<?php if($page->street()->isNotEmpty()): ?><span property="streetAddress"><?php echo $page->street()->smartypants(); ?></span><br><?php endif; ?>
			<?php if($page->zip()->isNotEmpty()): ?><span property="postalCode" class="is-hidden-visually"><?php echo $page->zip()->html(); ?></span><?php endif; ?>
			<?php if($page->city()->isNotEmpty()): ?><span property="addressLocality"><?php echo $page->city()->smartypants(); ?></span>,<?php endif; ?>
			<?php if($page->country()->isNotEmpty()): ?><span property="addressCountry"><?php echo $page->country()->smartypants(); ?></span><?php endif; ?>
	</span><br>
	<?php endif; ?>
	<?php if($page->phone()->isNotEmpty()): ?><?php if(s::get('device_class') == 'mobile'): echo '<a href="tel:' . rawurlencode($page->phone()->html()) . '">'; endif; ?><span property="telephone"><?php echo $page->phone()->html(); ?></span><?php if(s::get('device_class') == 'mobile'): ?></a><?php endif; ?><br><?php endif; ?>
	<?php if($page->email()->isNotEmpty()): ?><a href="mailto:<?php echo $page->email()->html(); ?>" property="email"><?php echo $page->email()->html(); ?></a><?php endif; ?>
	<?php if($page->site()->url()): ?><a href="<?php echo $site->url(); ?>" property="url" class="is-hidden-visually"><?php echo $page->site()->url(); ?></a><br><?php endif; ?>
	<?php if($page->vat()->isNotEmpty()): ?>vat number <span property="taxID"><?php echo $page->vat()->html(); ?></span><?php endif; ?>
</div>
