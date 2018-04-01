<url>
    <loc><?= html($page->url()) ?></loc>
    <lastmod><?= date('c', $page->modified()) ?></lastmod>

    <?php if ($languages && $languages->count() > 1) : ?>
    <?php foreach ($languages as $lang) : ?>
	<?php if (isset($page->inventory()['content'][$lang->code()])) : ?>
    <xhtml:link hreflang="<?= $lang->code() ?>" href="<?= html($page->url($lang->code())) ?>" rel="alternate" />
	<?php endif ?>
    <?php endforeach ?>
    <?php endif ?>

    <?php if (c::get('sitemap.priority', false)) : ?>
    <priority><?= $page->priority() ?></priority>
    <?php endif ?>

    <?php if (c::get('sitemap.frequency', false)) : ?>
    <changefreq><?= $page->frequency() ?></changefreq>
    <?php endif ?>

    <?php if (c::get('sitemap.include.images', true) && $page->hasImages()) : ?>
    <?php foreach ($page->images() as $image) : ?>
    <?php snippet('sitemap.image', compact('image')) ?>
    <?php endforeach ?>
    <?php endif ?>
</url>
