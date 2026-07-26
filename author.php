<?php 
get_header();
$profilduzenle = get_option('filmplus_profilduzenle_page_id'); 
if(isset($_GET['author_name'])) :
	$profil = get_userdatabylogin($author_name);
	get_userdatabylogin(get_the_author_login());
	(get_the_author_login());
else :
	$profil = get_userdata(intval($author));
endif;
$face = get_the_author_meta( 'facebook', $profil->ID );
$twt = get_the_author_meta( 'twitter', $profil->ID );
$insta = get_the_author_meta( 'instagram', $profil->ID );
$username = get_the_author_meta( 'user_nicename', $profil->ID );
$ad = get_the_author_meta( 'first_name', $profil->ID );
$soyad = get_the_author_meta( 'last_name', $profil->ID );
$face = str_replace("@","",$face);
$twt = str_replace("@","",$twt);
$insta = str_replace("@","",$insta);
if ($ad == "") {
    $display =  $username;
} 
else {
    $display = $ad.' '.$soyad;
}
?>
<div id="content">
	<div class="incontentalt">
		<div class="title">
			<h1 class="title-border bd-purple"><i class="fa fa-user"></i> <?php echo $display?></h1> 
			<?php if($profil->ID == $user_ID) { ?><a id="edit" href="<?php echo get_permalink($profilduzenle) ?>"><?php echo filmplus_profil_duzenle; ?> <i class="fa fa-edit"></i></a><?php } ?>
		</div>
		<div class="user-left">
			<div class="profile-avatar">
				<?php echo get_avatar($profil->ID, '130', null); ?>
			</div>
		</div>
		<div class="user-right">
			<div class="profile-options">
				<div class="title">
					<span class="title-border bd-blue"><i class="fa fa-info-circle"></i> <?php echo filmplus_hakkimda; ?></span> 
					<div style="float:right;">
						<?php if($face):?><a href="https://www.facebook.com/<?php echo $face;?>" target="_blank" id="face"><i class="fab fa-facebook-f"></i> <span class="nomob">Facebook</span></a><?php endif;?>
						<?php if($twt):?><a href="https://twitter.com/<?php echo $twt;?>" target="_blank" id="twt"><i class="fab fa-twitter"></i> <span class="nomob">Twitter</span></a><?php endif;?>
						<?php if($insta):?><a href="https://www.instagram.com/<?php echo $insta;?>" target="_blank" id="insta"><i class="fab fa-instagram"></i> <span class="nomob">İnstagram</span></a><?php endif;?>
					</div>
				</div>
				<ul>
					<?php if($profil->user_description) { ?><?php echo $profil->user_description; ?><?php }else { ?><?php echo filmplus_biyografi; ?><?php } ?>
				</ul>
				<li>
					<span><i class="fa fa-calendar"></i> <?php echo filmplus_kayit_tarihi; ?>  <?php echo date( "d.m.Y", strtotime($profil->user_registered)) ;?></span>
				</li>
			</div>
		</div>
		<?php if($profil->ID == $user_ID) { ?>
		<div class="sonrakiler">
			<div class="title">
				<span class="title-border"><i class="fas fa-star"></i> <?php echo filmplus_favorilerim; ?></span>
				<div id="temizle">
					<a href="<?php echo get_permalink(get_option('filmplus_favorites_page_id')) ?>"><i class="fas fa-share"></i> <?php echo filmplus_tumunu_gor;?></a>
				</div>
			</div>
			<div class="userList">
				<?php 
				$user_id = get_current_user_id();
				$users_fav_list = get_user_meta($user_id,'users_fav_list',true);
				if(empty($users_fav_list)) $users_fav_list = array();
				$users_fav_list = array_reverse($users_fav_list);
				query_posts(array('post__in' => $users_fav_list, 'orderby' => 'post__in', 'showposts' => 6, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'post_type' => array('post','anime'))); ?>
				<?php if ( have_posts() && !empty($users_fav_list)) : while ( have_posts() ) : the_post(); ?>
				<?php echo '<div class="remove_fav_'.get_the_ID().' remove_wh">';?>
				<?php include (TEMPLATEPATH . '/filmlist.php');?>
				<?php filmplus_display_remove_from_favorite();?>
				<?php echo '</div>';?>
				<?php endwhile; else: ?>
				<div class="emptyList"><?php echo filmplus_izleme_listesi_bos;?></div>
				<?php endif; ?>
			</div>
		</div>
		<div class="sonrakiler">
			<div class="title">
				<span class="title-border bd-green"><i class="fa fa-check-circle"></i> <?php echo filmplus_izlediklerim; ?></span>
				<div id="temizle">
					<a href="<?php echo get_permalink(get_option('filmplus_watched_page_id')) ?>"><i class="fas fa-share"></i> <?php echo filmplus_tumunu_gor;?></a>
				</div>
			</div>
			<div class="userList">
				<?php 
				$user_id = get_current_user_id();
				$users_wh_list = get_user_meta($user_id,'users_wh_list',true);
				if(empty($users_wh_list)) $users_wh_list = array();
				$users_wh_list = array_reverse($users_wh_list);
				query_posts(array('post__in' => $users_wh_list, 'orderby' => 'post__in', 'showposts' => 6, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'post_type' => array('post','anime'))); ?>
				<?php if ( have_posts() && !empty($users_wh_list)) : while ( have_posts() ) : the_post(); ?>
				<?php echo '<div class="remove_wh_'.get_the_ID().' remove_wh">';?>
				<?php include (TEMPLATEPATH . '/filmlist.php');?>
				<?php filmplus_display_remove_from_watched();?>
				<?php echo '</div>';?>
				<?php endwhile; else: ?>
				<div class="emptyList"><?php echo filmplus_izleme_listesi_bos;?></div>
				<?php endif; ?>
			</div>
		</div>
		<div class="sonrakiler">
			<div class="title">
				<span class="title-border bd-blue"><i class="fas fa-history"></i> <?php echo filmplus_izleyeceklerim; ?></span>
				<div id="temizle">
					<a href="<?php echo get_permalink(get_option('filmplus_watchlater_page_id')) ?>"><i class="fas fa-share"></i> <?php echo filmplus_tumunu_gor;?></a>
				</div>
			</div>
			<div class="userList">
				<?php 
				$user_id = get_current_user_id();
				$users_wl_list = get_user_meta($user_id,'users_wl_list',true);
				if(empty($users_wl_list)) $users_wl_list = array();
				$users_wl_list = array_reverse($users_wl_list);
				query_posts(array('post__in' => $users_wl_list, 'orderby' => 'post__in', 'showposts' => 6, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'post_type' => array('post','anime'))); ?>
				<?php if ( have_posts() && !empty($users_wl_list)) : while ( have_posts() ) : the_post(); ?>
				<?php echo '<div class="remove_wl_'.get_the_ID().' remove_wh">';?>
				<?php include (TEMPLATEPATH . '/filmlist.php');?>
				<?php filmplus_display_remove_from_watchlater();?>
				<?php echo '</div>';?>
				<?php endwhile; else: ?>
				<div class="emptyList"><?php echo filmplus_izleme_listesi_bos;?></div>
				<?php endif; ?>
			</div>
		</div>
		<?php } ?>
		<div class="user-comment">
			<div class="title">
				<span class="title-border bd-purple"><i class="fa fa-comments"></i> <?php echo filmplus_yorum_yaptim; ?></span>
			</div>
			<?php
			$thisauthor = get_userdata(intval($author));
			$querystr = "SELECT comment_ID, comment_post_ID, post_title, comment_content
			FROM $wpdb->comments, $wpdb->posts
			WHERE user_id = $thisauthor->ID
			AND comment_post_id = ID
			AND comment_approved = 1
			ORDER BY comment_ID DESC
			LIMIT 3";
			$comments_array = $wpdb->get_results($querystr, OBJECT); if ($comments_array): ?>
			<ul>
				<?php foreach ($comments_array as $comment):setup_postdata($comment); ?>
				<li>
					<div class="user-basl">
						<a href="<?php echo get_permalink($comment->comment_post_ID); ?>"><?php echo($comment->post_title) ?></a>
					</div>
					<p><?php comment_excerpt($comment->comment_ID); ?></p>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php else : ?>
			<ul>
				<li>
					<div class="user-basl">?????</div>
					<p><?php echo filmplus_gorus_yok; ?></p>
				</li>
			</ul>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer();?>