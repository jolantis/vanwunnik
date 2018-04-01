<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------
////////////////////////////////////////////////////////// ?>

<?php if($prev || $next): ?>
	<nav role="navigation" class="contain-padding">
		<h2 class="is-hidden-visually"><?php echo l::get('page navigation'); ?></h2>

		<ul class="pagination aligner aligner--wrap">
			<?php if($next): ?>
				<li class="pagination__item pagination__item--newer">
					<a href="<?php echo $next->url(); ?>" class="button button--border-dark icon icon--left">
						<svg role="presentation" width="24" height="24">
							<title><?php echo l::get('left arrow title'); ?></title>
							<desc><?php echo l::get('left arrow desc'); ?></desc>
							<use xlink:href="/assets/images/sprite.svg#arrow-left"/>
						</svg>
						<?php echo $next->title()->smartypants(); ?>
					</a>
				</li>
			<?php endif ?>

			<?php if($prev): ?>
				<li class="pagination__item pagination__item--older aligner__item--right">
					<a href="<?php echo $prev->url(); ?>" class="button button--border-dark icon icon--right">
						<?php echo $prev->title()->smartypants(); ?>
						<svg role="presentation" width="24" height="24">
							<title><?php echo l::get('right arrow title'); ?></title>
							<desc><?php echo l::get('right arrow desc'); ?></desc>
							<use xlink:href="/assets/images/sprite.svg#arrow-right"/>
						</svg>
					</a>
				</li>
			<?php endif ?>
		</ul>
	</nav>
<?php endif; ?>
