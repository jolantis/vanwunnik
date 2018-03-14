<?php snippet('html-head', array('criticalcss' => 'journal')); ?>

	<?php snippet('banner'); ?>

	<main role="main" class="contain-padding">

		<h1 class="beta-heading is-hidden-visually">
			<?php echo ($page->long_title()->exists() && $page->long_title()->isNotEmpty()) ? $page->long_title()->smartypants()->widont() : $page->title()->smartypants()->widont(); ?>
		</h1>

		<?php snippet('filters', array('filter_key' => 'tags', 'sort' => 'abc')); ?>
		<?php //snippet('filters'); ?>

		<section class="grid grid--gutter">
			<h2 class="is-hidden-visually">
				Journal posts
				<?php echo ($filter_value) ? '(tagged with: ' . tagunslug($filter_value) . ')' : ''; ?>
			</h2>
			<?php foreach ($page_items as $page_item) : ?>

				<?php $page_item_image = ($page_item->images()->filterBy('filename','*=','main')->first()) ? $page_item->images()->filterBy('filename','*=','main')->first() : $page_item->images()->sortBy('sort', 'asc')->first(); ?>

				<article class="grid__cell medium-1of2" id="<?php echo $page_item->slug(); ?>">
					<a href="<?php echo $page_item->url(); ?>" class="bg-image bg-image--link">
						<?php // echo $page_item_image->imageset('grid'); ?>
						<?php echo $page_item_image->imageset('grid', ['output' => 'bgimage']); ?>
						<span class="bg-text aligner aligner--stacked aligner--bottom">
							<h2 class="bg-text__title"><?php echo $page_item->title()->smartypants()->widont(); ?></h2>
							<?php /* <p class="bg-text__meta"><?php snippet('datetime', ['relative' => true, 'page' => $page_item]); ?> &nbsp;&mdash;&nbsp; <?php echo $page_item->images()->count(); ?> photos</p> */ ?>
							<p class="bg-text__meta"><?php echo l::get('posted'); snippet('datetime', ['relative' => true, 'page' => $page_item]); ?></p>
						</span>
					</a>
				</article>

			<?php endforeach; ?>
		</section>

	</main>

	<?php snippet('nav-pagination'); ?>

	<?php snippet('contentinfo'); ?>

<?php snippet('html-foot'); ?>
