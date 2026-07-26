<?php 
get_header(); 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>
<?php if(get_option('filmplus_slider') == 'On'): ?>
<?php if(get_option('filmplus_slider_tipi') == 'tip2'): ?><?php include(TEMPLATEPATH . '/slider2.php');?><?php else:?><?php include(TEMPLATEPATH . '/slider.php');?><?php endif; ?>
<?php endif; ?>
<div id="content">	
	<div class="incontent">
		<?php if (is_active_sidebar('anasayfa-ust')) { ?>
		<div class="nomob2">
			<?php dynamic_sidebar('anasayfa-ust'); ?>
		</div>
		<?php } ?>
		<div class="title">
			<span class="title-border bd-green"><i class="fas fa-upload"></i> <?php echo filmplus_son_eklenen_filmler;?></span>
			<div class="tumunugor">
				<a href="<?php echo get_permalink(get_option('filmplus_arsiv_page_id')) ?>"><i class="fas fa-arrow-right"></i> <?php echo filmplus_tumunu_gor;?></a>
			</div>
		</div>
		<div id="listehizala">
			<?php query_posts(array('paged' => $paged, 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => get_option('filmplus_sayfa_basi'), 'post_type' => 'post'));?>
			<?php if(have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>        
			<?php include (TEMPLATEPATH . '/filmlist.php');?>
			<?php endwhile; ?>    
			<?php endif; ?>
		</div>
		<?php if(get_option('filmplus_homepage_pagination') == 'On'): ?><div class="sayfalama"><?php filmplus_sayfalama();?></div><?php endif; ?>
		<?php if (is_active_sidebar('anasayfa-alt')) { ?>
		<div class="nomob2">
			<?php dynamic_sidebar('anasayfa-alt'); ?>
		</div>
		<?php } ?>
	</div>
<?php get_sidebar();?>
</div>
<?php get_footer(); ?>