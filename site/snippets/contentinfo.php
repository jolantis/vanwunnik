<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// PARTIAL
// ----------------------------------------------------------
////////////////////////////////////////////////////////// ?>

<div role="contentinfo" class="contentinfo">
	<div class="copy copy--contain delta-heading space-trailer-m">
		<?php // echo $site->footer_text()->kirbytext(); ?>
		<?php
			$date1 = new DateTime('now');
			$date2 = new DateTime('1973-03-11');
			$interval = $date1->diff($date2);
			$years = $interval->y;
			// $formatter = new NumberFormatter("en", NumberFormatter::SPELLOUT);
			// $formatter->format($years)
		?>
		<?php echo kirbytext($years . ' ' . l::get('mystery of nature')); ?>
	</div>

	<div class="contain-padding">
		<?php snippet('nav-main', array('location' => 'footer')); ?>
		<?php snippet('language-toggle', array('location' => 'footer')); ?>
	</div>

	<footer class="contain-padding">
		<p><?php echo '2007&ndash;' . date("Y"); ?> <a href="https://vanwunnik.com" rel="me"><?php echo $site->copyright()->smartypants(); ?></a></p>
		<?php if(site()->language()->code() == 'nl'): ?>
			<p>Alle werken vallen onder een <a rel="license" href="https://creativecommons.org/licenses/by-nc-nd/4.0/deed.nl" title="Creative Commons Naamsvermelding-NietCommercieel-GeenAfgeleideWerken 4.0 Internationaal">CC BY-NC-ND licentie</a></p>
		<?php else: ?>
			<p>All contents licensed under a <a rel="license" href="https://creativecommons.org/licenses/by-nc-nd/4.0/" title="Creative Commons Attribution-Non-Commercial-No-Derivs 4.0 International">CC BY-NC-ND license</a></p>
		<?php endif; ?>
	</footer>
</div>
