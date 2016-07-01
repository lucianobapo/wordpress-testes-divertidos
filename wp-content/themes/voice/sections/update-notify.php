<!-- Show this box once the theme is updated -->
<?php 
		$protocol = isset( $_SERVER['https'] ) ? 'https://' : 'http://';
		$vce_ajax_url = admin_url( 'admin-ajax.php', $protocol );
?>
<script>
	(function($) {
		$(document).ready(function() {
				$("body").on('click', '#vce_update_box_hide',function(e){
	    			e.preventDefault();
	    			$(this).parent().parent().remove();
	    			$.post('<?php echo $vce_ajax_url; ?>', {action: 'vce_update_version'}, function(response) {});
    			});

				$("body").on('click', '#vce_feedback a',function(e){
	    			e.preventDefault();
	    			var wrap_id = $(this).attr("data-wrap");
	    			$('.vce_feedback_wrap').hide();
	    			$('#vce_feedback').hide();
	    			$('#'+wrap_id).show();
	    			$('#vce_feedback a').removeClass('selected');
	    			$(this).toggleClass('selected');
    			});

		});
	})(jQuery);

</script> 

<h3>Congratulations, your website just got better!</h3>
<p><strong><?php echo THEME_NAME; ?></strong> theme has been successfully updated to <strong>version <?php echo THEME_VERSION; ?>.</strong></p>
<p><a href="http://demo.mekshq.com/voice/documentation/#changelog" target="_blank" class="button-primary">View changelog</a></p>
<div class="feedback_wrapper">

<h3>How do you feel about Voice theme so far?</h3>
<ul id="vce_feedback">
	<li><a href="" class="happy_link" data-wrap="vce_happy_wrap">Happy</a></li>
	<li><a href="" class="sad_link" data-wrap="vce_sad_wrap">Sad</a></li>
</ul>
<div id="vce_happy_wrap" class="vce_feedback_wrap">
	<p><strong>Great! That's why we have to work hard every day! <br/> Let more people know about Voice and help us make our products better!</strong></p>
	<?php get_template_part('sections/theme-share'); ?>
	<h3>Stay connected:</h3>
	<p>Join us and stay up to date with our latest news and releases.</p>
	<p><a href="http://facebook.com/mekshq" target="_blank"><i class="el-icon-facebook"></i> Facebook</a> | <a href="http://twitter.com/mekshq" target="_blank"><i class="el-icon-twitter"></i> Twitter</a> | <a href="http://eepurl.com/TBPOb" target="_blank"><i class="el-icon-envelope"></i>  Newsletter</a></p>
	<h3>Want to see more from us?</h3>
	<p>Feel free to check our other items available on ThemeForest!</p>
	<ul class="mks_themes">
		<li><a class="mks_themes_item" href="http://themeforest.net/item/throne-personal-blogmagazine-wordpress-theme/8134834?mks_un" target="_blank"><img src="https://0.s3.envato.com/files/96760148/throne_thumbnail_v4_smaller.png"/> Throne - Personal Blog/Magazine WordPress Theme </a> 
			<a href="http://demo.mekshq.com/?theme=throne&mks_un" target="_blank" class="button-primary">Demo</a> 
			<a class="button-primary" href="http://themeforest.net/item/throne-personal-blogmagazine-wordpress-theme/8134834?mks_un" target="_blank">Features</a>
		</li>
		<li><a class="mks_themes_item" href="http://themeforest.net/item/seashell-modern-responsive-wordpress-blog-theme/6737517?mks_un" target="_blank"><img src="https://0.s3.envato.com/files/80644314/seashell_thumb_03.png"/> SeaShell - Modern Responsive WordPress Blog Theme</a>
			<a href="http://demo.mekshq.com/?theme=seashell&mks_un" target="_blank" class="button-primary">Demo</a> 
			<a class="button-primary" href="http://themeforest.net/item/seashell-modern-responsive-wordpress-blog-theme/6737517?mks_un" target="_blank">Features</a>
		</li>
		<li><a class="mks_themes_item" href="http://themeforest.net/item/safarica-smart-and-creative-wordpress-blog-theme/5391166?mks_un" target="_blank"><img src="https://2.s3.envato.com/files/90359736/safarica_02.png"/> Safarica - Smart And Creative WordPress Blog Theme </a> 
			<a href="http://demo.mekshq.com/?theme=safarica&mks_un" target="_blank" class="button-primary">Demo</a> 
			<a class="button-primary" href="http://themeforest.net/item/safarica-smart-and-creative-wordpress-blog-theme/5391166?mks_un" target="_blank">Features</a>
		</li>
	</ul>
</div>

<div id="vce_sad_wrap" class="vce_feedback_wrap">
	<p><strong>Yikes! Sorry to hear that.</strong></p>
	<p>If you have any issues with the theme or any ideas how we can improve it, do not hesitate to <a href="http://mekshq.com/contact" target="_blank">contact our support</a>.</p>
	<p>Also, if you find this theme hard to use, please <a href="http://demo.mekshq.com/voice/documentation" target="_blank">visit our documentation</a> in order to find some answers about the setup.</p>
</div>
</div>
<p class="description"><a href="#" id="vce_update_box_hide">Hide this message</a></p>