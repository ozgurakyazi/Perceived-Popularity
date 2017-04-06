<?php $author = get_the_author(); ?>
<div class="post-author">
 
	<div class="author-img">
		<?php 
			if(get_the_author_meta('alternate_image')){
				$imgurl = get_the_author_meta('alternate_image');
				echo '<img class="avatar avatar-100 photo" src="'.$imgurl.'" alt="'.$author.' profile photo" width="100" height="100"/>';
			}else{
				echo get_avatar( get_the_author_meta('email'), '100' );
			} 
		?>
	</div>
	<div class="author-content">
		<?php if(!is_author()): ?>
	    	<div class="author-title">
	    		<?php the_author_posts_link(); ?>
	    	</div>
	    <?php endif; ?>

        <?php if(get_the_author_meta('twitter')) : ?>
        	<h6><a target="_blank" class="author-social" href="http://twitter.com/<?php echo the_author_meta('twitter'); ?>">@<?php echo the_author_meta('twitter'); ?></a></h6>
        <?php endif; ?>

		<div class="author-description">
			<p><?php the_author_meta('description'); ?></p>
			<div class="author-sn">

				<?php if(get_the_author_meta('facebook_profile')) : ?><a target="_blank" class="hastip-author author-social" title="Facebook" href="http://facebook.com/<?php echo the_author_meta('facebook_profile'); ?>"><i class="fa fa-facebook"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('twitter_profile')) : ?><a target="_blank" class="hastip-author author-social" title="Twitter" href="http://twitter.com/<?php echo the_author_meta('twitter_profile'); ?>"><i class="fa fa-twitter"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('instagram_profile')) : ?><a target="_blank" class="hastip-author author-social" title="Instagram" href="http://instagram.com/<?php echo the_author_meta('instagram_profile'); ?>"><i class="fa fa-instagram"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('google_profile')) : ?><a target="_blank" class="hastip-author author-social" title="Google+" href="http://plus.google.com/<?php echo the_author_meta('google_profile'); ?>?rel=author"><i class="fa fa-google-plus"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('pinterest_profile')) : ?><a target="_blank" class="hastip-author author-social" title="Pinterest" href="http://pinterest.com/<?php echo the_author_meta('pinterest_profile'); ?>"><i class="fa fa-pinterest"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('tumblr_profile')) : ?><a target="_blank" class="hastip-author author-social" title="Tumblr" href="http://<?php echo the_author_meta('tumblr_profile'); ?>.tumblr.com/"><i class="fa fa-tumblr"></i></a><?php endif; ?>
			</div>
		</div>
	</div>
	
</div>