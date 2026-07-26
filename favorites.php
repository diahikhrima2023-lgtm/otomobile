<?php
/*
Template Name: Favorilerim
*/
if( !is_user_logged_in() ) { wp_redirect( home_url() ); exit; }
$user_id = get_current_user_id();
$users_fav_list = get_user_meta($user_id,'users_fav_list',true);
if(empty($users_fav_list)) $users_fav_list = array();
$users_fav_list = array_reverse($users_fav_list);
if(isset($_GET['ara'])) {
	$search = esc_html($_GET['ara']);
	$message = filmplus_film_bulunamadi;
}
else {
	$search = "";
	$message = filmplus_favori_listesi_bos;
}
get_header();?>
<div id="content">
	<div class="incontentalt" id="mylist">
		<div class="title">
			<h1 class="title-border"><i class="fas fa-star"></i> <?php the_title(); ?></h1>
			<form id="mylistform" method="GET">
				<input type="text" id="ara" value="<?php if(isset($_GET['ara'])) echo esc_html($_GET['ara']);?>" name="ara" placeholder="<?php echo filmplus_favori_ara;?>"><i class="fas fa-search"></i>
			</form>
		</div>
		<div id="listehizala">
			<?php query_posts(array('paged' => get_query_var('paged'), 's' => $search, 'post__in' => $users_fav_list, 'orderby' => 'post__in', 'posts_per_page' => 18, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'post_type' => array('post','anime'))); ?>
			<?php if ( have_posts() && !empty($users_fav_list)) : while ( have_posts() ) : the_post(); ?>
			<?php echo '<div class="remove_fav_'.get_the_ID().' remove_wh">';?>
			<?php include (TEMPLATEPATH . '/filmlist.php');?>
			<?php filmplus_display_remove_from_favorite();?>
			<?php echo '</div>';?>
			<?php endwhile; else: ?>
			<div class="emptyList"><?php echo $message;?></div>
			<?php endif; ?>
		</div>
		<?php if(!empty($users_fav_list)):?><div class="sayfalama"><?php filmplus_sayfalama();?></div><?php endif;?>
	</div>
</div>
<?php get_footer();?>