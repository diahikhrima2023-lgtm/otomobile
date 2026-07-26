<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) { ?>
	<p class="nocomments"><?php echo filmplus_yorum_koruma; ?></p>
	<?php
	return;
	}
?>
<?php if ('open' == $post->comment_status) : ?>
<?php global $current_user;?>
<div id="respond">
	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	<p class="girisyapin"><?php echo filmplus_yorum_giris; ?></p>
	<?php else : ?>
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		<div id="areapos">
			<p><textarea placeholder="<?php echo filmplus_mesajiniz; ?>" name="comment" id="comment" cols="40" rows="3" tabindex="4"></textarea></p>
			<span class="cancel-comment-reply"><small><?php cancel_comment_reply_link(); ?></small></span>
		</div>
		<?php if ( is_user_logged_in() ) : ?>
		<div id="commentprofil">
			<div id="profilsola">
				<p class="merhaba">
					<?php echo filmplus_merhaba;?> <a href="<?php echo get_option('siteurl'); ?>/profil/<?php echo $current_user->user_nicename;?>"><?php echo $current_user->user_nicename;?></a>
					<small class="hemenyaz"><?php echo filmplus_yorum_yaz; ?></small>
				</p>
				<p class="cikis"><a href="<?php echo wp_logout_url(get_permalink()); ?>"> (<?php echo filmplus_cikis; ?>)</a></p></p>
			</div>
			<div id="mailpos"><?php echo get_avatar( null, '60', null); ?></div>
		</div>
		<?php else : ?>
		<div id="commentpos">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td class="yborder" align="left" valign="top">
							<input placeholder="<?php echo filmplus_adiniz; ?>" name="author" id="name" value="" size="50" tabindex="1" type="text">
						</td>
					</tr>
					<tr>
						<td class="yborder" align="left" valign="top">
							<input placeholder="<?php echo filmplus_mailiniz; ?>" name="email" id="email" value="" size="50" tabindex="2" type="text">
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php endif; ?>
		<div id="gonderpos">
			<button type="button" id="gonderspo" tabindex="5"><i class="fas fa-exclamation-circle" ></i><?php echo filmplus_spoiler_ekle; ?></button>
			<button name="submit" type="submit" id="gonder" tabindex="5"><i class="fas fa-paper-plane"></i><?php echo filmplus_yorumu_gonder; ?></button>
			<?php comment_id_fields(); ?>
		</div>
	</form>
	<?php endif;?>
	<?php if ( have_comments() ) : ?>
	<div id="listpost">
		<?php filmplus_get_popular_comment($post->ID,'5','5');?>
			<ul class="commentlist">
				<?php wp_list_comments( 'type=comment&callback=filmplus_comment' ); ?>
			</ul>
			<?php paginate_comments_links( array('prev_text' => '&laquo;', 'next_text' => '&raquo;') ); ?>
	</div>
	<?php else : ?>
	<?php if ('open' == $post->comment_status) : ?>
	<?php else:?>
	<div class="yorumkapali"><i class="fas fa-ban"></i> <?php echo filmplus_yorum_kapali; ?></div>
	<?php endif; ?>
	<?php endif; ?>
</div>
<?php endif;?>