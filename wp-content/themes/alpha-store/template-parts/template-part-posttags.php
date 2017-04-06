<?php if ( has_tag() ) : ?>
	<p class="text-left"><span class="fa fa-tags"></span>
		<span itemprop="keywords"><?php the_tags(); ?></span>
	</p>
<?php endif; ?>