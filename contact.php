<?php
/*
Template Name: İletişim Sayfası
*/
get_header();
?>
<div id="content">
	<div class="iletisimalani">
		<div class="title">
			<h1 class="title-border bd-purple"><i class="fa fa-envelope"></i> <?php the_title(); ?></h1>  
		</div>
		<div class="iletisimcontent">
			<?php echo do_shortcode('[wpforms id="'.get_option('filmplus_iletisim_form_post_id').'" title="false" description="false"]') ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>