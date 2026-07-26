<div id="footer">
	<div class="footerleft">
		<?php if(get_option('filmplus_footer_left')) { echo get_option('filmplus_footer_left'); } else { echo 'Copyright &copy; '.date('Y').' <a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a>'; echo "</br>"; echo '<span>'.filmplus_tum_haklar_sakli.'</span>'; } ?>
	</div>
	<?php 
	if(get_option('filmplus_r_c') == 'On') { echo'<div id="header_sol">'; echo get_option('filmplus_r_c_c'); echo '</div>'; }
	if(get_option('filmplus_r_d') == 'On') { echo'<div id="header_sag">'; echo get_option('filmplus_r_d_d'); echo '</div>'; }
	?>
	<?php if(get_option('filmplus_sosyal') == 'On'): ?>
	<div class="footeright">
	    <?php if(get_option('filmplus_facebook_id')) { ?>
	    <a href="<?php echo get_option('filmplus_facebook_id'); ?>" target="_blank"><i class="fab fa-facebook-square"></i></i></a>
	    <?php } ?>
		<?php if(get_option('filmplus_twitter_id')) { ?>
	    <a href="<?php echo get_option('filmplus_twitter_id'); ?>" target="_blank"><i class="fab fa-twitter-square"></i></a>
	    <?php } ?>
		<?php if(get_option('filmplus_instagram_id')) { ?>
	    <a href="<?php echo get_option('filmplus_instagram_id'); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
	    <?php } ?>
	</div>
	<?php endif; ?>
</div>
<?php if(get_option('filmplus_r_f') == 'On'): ?>
<?php footer_reklam();?>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>