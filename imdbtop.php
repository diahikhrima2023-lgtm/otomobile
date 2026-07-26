<?php
/*
Template Name: IMDb En İyiler
*/
get_header();?>
<div id="content">
	<div class="incontent">
		<div class="title">
			<h1 class="title-border bd-purple"><i class="fas fa-star"></i> <?php the_title(); ?></h1>
		</div>
		<div id="listehizala">
		<?php query_posts(array('paged' => get_query_var('paged'), 'orderby' => 'meta_value_num', 'meta_key' => 'imdb', 'order' => 'DESC', 'posts_per_page' => get_option('filmplus_sayfa_basi'), 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'post_type' => 'post'));?>
		<?php if(have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>        
		<?php include (TEMPLATEPATH . '/filmlist.php');?>
		<?php endwhile; ?>    
		<?php endif; ?>
		</div>
		<div class="sayfalama"><?php filmplus_sayfalama();?></div>
	</div>
<?php get_sidebar();?>
</div>
<?php get_footer();?>