<?php
/**
 * Archive template for the `anime` Custom Post Type.
 *
 * Renders the list of anime series entries using the existing theme
 * listing markup (filmlist.php card) and pagination, following the same
 * conventions as category.php / taxonomy.php.
 *
 * Requirements: 5.4
 */
get_header(); ?>
<div id="content">
	<div class="incontent">
		<div class="title">
			<h1 class="title-border bd-purple"><i class="fa fa-play-circle"></i> <?php echo filmplus_anime_label('filmplus_anime_archives', 'Anime Archive'); ?></h1>
		</div>
		<div id="listehizala">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php include (TEMPLATEPATH . '/filmlist.php');?>
			<?php endwhile; else: ?>
			<div id="bulunamadi"><?php echo filmplus_anime_label('filmplus_anime_not_found', 'No anime found.'); ?></div>
			<?php endif; ?>
		</div>
		<div class="sayfalama"><?php filmplus_sayfalama();?></div>
	</div>
	<?php get_sidebar();?>
</div>
<?php get_footer();?>
