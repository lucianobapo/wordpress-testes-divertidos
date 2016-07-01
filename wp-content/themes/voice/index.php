<?php

get_header(); ?>
  <style type="text/css">
    .ads-head-r{ margin: auto; max-width: 1140px; margin-top: 0px; margin-top: 20px;}
    .ads-footer-r{ margin: auto; max-width: 1140px; margin-bottom: 30px; margin-top: 0px;}
  </style>
    <div class="ads-head-r">
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- Sidebar-TD-Responsivo -->
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="ca-pub-1364233972166119"
           data-ad-slot="7193927588"
           data-ad-format="auto"></ins>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </div>
<div id="content" class="container site-content">

	<?php global $vce_sidebar_opts; ?>
	<?php if ( $vce_sidebar_opts['use_sidebar'] == 'left' ) { get_sidebar(); } ?>
		
	<div id="primary" class="vce-main-content">
		
		<div class="main-box">

			

			<div class="main-box-inside">
			
			<?php if ( have_posts() ) : ?>
				
				<div class="vce-loop-wrap">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'sections/loops/layout-'.vce_get_archive_layout()); ?>
				<?php endwhile; ?>
				</div>
				<?php get_template_part( 'sections/pagination/'.vce_get_archive_pagination()); ?>

			<?php else: ?>
				
				<?php get_template_part( 'sections/content-none'); ?>

			<?php endif; ?>

			</div>

		</div>

	</div>

	<?php if ( $vce_sidebar_opts['use_sidebar'] == 'right' ) { get_sidebar(); } ?>

</div>

  <div class="paginacao">
    <div class="interna-paginacao">
      <?php wp_pagenavi (); ?>
    </div>
  </div>

    <div class="ads-footer-r">
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- Sidebar-TD-Responsivo -->
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="ca-pub-1364233972166119"
           data-ad-slot="7193927588"
           data-ad-format="auto"></ins>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </div>

<?php get_footer(); ?>