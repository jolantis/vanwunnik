<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------
////////////////////////////////////////////////////////// ?>

<?php if($pagination && $pagination->hasPages()): ?>
	<nav role="navigation" class="contain-padding">
		<h2 class="is-hidden-visually">Page navigation</h2>
		<ul class="pagination aligner aligner--wrap">
			<?php if($pagination->hasPrevPage()): ?>
				<li class="pagination__item pagination__item--newer">
					<?php if($page_num == 2): ?>
						<a href="<?php echo url(((site()->language()->code() != site()->defaultLanguage()->code()) ? site()->language()->code() . '/' : '') . page()->slug() . (($filter_value) ? '/' . (($filter_key == 'tags') ? 'tag' : $filter_key) . '/' . $filter_value : '')); ?>" class="button button--border-dark icon icon--left">
					<?php else: ?>
						<a href="<?php echo url(((site()->language()->code() != site()->defaultLanguage()->code()) ? site()->language()->code() . '/' : '') . page()->slug() . (($filter_value) ? '/' . (($filter_key == 'tags') ? 'tag' : $filter_key) . '/' . $filter_value : '') . '/' . l::get('page') . '/' . ($page_num - 1)); ?>" class="button button--border-dark icon icon--left">
					<?php endif; ?>
							<svg role="presentation" width="24" height="24">
								<title><?php echo l::get('left arrow title'); ?></title>
								<desc><?php echo l::get('left arrow desc'); ?></desc>
								<use xlink:href="/assets/images/sprite.svg#arrow-left"/>
							</svg>
							<?php echo smartypants(l::get('prev')); ?>
						</a>
				</li>
			<?php endif; ?>

			<?php if($pagination->hasNextPage()): ?>
				<li class="pagination__item pagination__item--older aligner__item--right">
					<a href="<?php echo url(((site()->language()->code() != site()->defaultLanguage()->code()) ? site()->language()->code() . '/' : '') . page()->slug() . (($filter_value) ? '/' . (($filter_key == 'tags') ? 'tag' : $filter_key) . '/' . $filter_value : '') . '/' . l::get('page') . '/' . ($page_num + 1)); ?>" class="button button--border-dark icon icon--right">
						<?php echo smartypants(l::get('next')); ?>
						<svg role="presentation" width="24" height="24">
							<title><?php echo l::get('right arrow title'); ?></title>
							<desc><?php echo l::get('right arrow desc'); ?></desc>
							<use xlink:href="/assets/images/sprite.svg#arrow-right"/>
						</svg>
					</a>
				</li>
			<?php endif; ?>
		</ul>
	</nav>
<?php endif; ?>
