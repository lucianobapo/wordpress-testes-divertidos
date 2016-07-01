<article id="post-<?php the_ID(); ?>" <?php post_class('vce-page'); ?>>

	<?php if ( vce_get_option( 'page_show_fimg' ) && has_post_thumbnail() ) : ?>
	 	<?php global $vce_sidebar_opts; $img_size = $vce_sidebar_opts['use_sidebar'] == 'none' ? 'vce-lay-a-nosid' : 'vce-lay-a'; ?>
	 	<div class="meta-image">
			<?php the_post_thumbnail( $img_size ); ?>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<h1 class="entry-title entry-title-page"><?php echo esc_html( get_the_title() ); ?></h1>
	</header>

	<div class="entry-content page-content">
		<?php the_content(); ?>
		<?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'next')); ?>
	</div>

</article>