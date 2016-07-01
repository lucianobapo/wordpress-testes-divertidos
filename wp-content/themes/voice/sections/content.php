<article id="post-<?php the_ID(); ?>" <?php post_class( 'vce-single' ); ?>>

	<header class="entry-header">
		<?php if ( vce_get_option( 'show_cat' ) ) : ?>
			<span class="meta-category"><?php echo vce_get_category(); ?></span>
		<?php endif; ?>
		<h1 class="entry-title"><?php echo esc_html( get_the_title() ); ?></h1>
		<div class="entry-meta"><?php echo vce_get_meta_data( 'single' ); ?></div>
	</header>

	<?php if( vce_is_paginated_post()) : ?>
		<?php if( vce_get_option('show_paginated') == 'above') : ?>
			<?php get_template_part('sections/paginated-nav'); ?>
		<?php endif; ?>
	<?php else: ?>

		<?php if ( vce_get_option('show_fimg') && has_post_thumbnail() ) : ?>
		 	<?php global $vce_sidebar_opts; $img_size = $vce_sidebar_opts['use_sidebar'] == 'none' ? 'vce-lay-a-nosid' : 'vce-lay-a'; ?>
		 	<div class="meta-image">
				<?php the_post_thumbnail( $img_size ); ?>
			</div>

			<?php if ( vce_get_option( 'show_author_img' ) ) : ?>
				<div class="meta-author">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
					<div class="meta-author-wrapped"><?php echo __vce( 'written_by' ); ?> <span class="vcard author"><span class="fn"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author_meta( 'display_name' ); ?></a></span></span></div>
			    </div>
			<?php endif; ?>

		<?php endif; ?>

	    <?php if ( vce_get_option( 'show_headline' ) && has_excerpt() ) : ?>
		    <div class="entry-headline">
		    	<?php the_excerpt(); ?>
		    </div>
	    <?php endif; ?>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		
	</div>

	<?php if( vce_is_paginated_post() && vce_get_option('show_paginated') == 'below') : ?>
		<?php get_template_part('sections/paginated-nav'); ?>
	<?php endif; ?>

	<?php if ( vce_get_option( 'show_tags' ) ) : ?>
		<footer class="entry-footer">
			<div class="meta-tags">
				<?php the_tags( false, ' ', false ); ?>
			</div>
		</footer>
	<?php endif; ?>

	<?php if ( vce_get_option( 'show_share' ) ) : ?>
	  	<?php get_template_part('sections/share-bar'); ?>
	<?php endif; ?>

</article>