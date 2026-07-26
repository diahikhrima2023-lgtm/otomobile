<?php get_header(); ?>
<div id="content">
	<div class="iletisimalani">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="title">
			<h1 class="title-border bd-purple"><?php the_title(); ?></h1>  
		</div>
		<div class="in-page">
			<?php the_content(); ?>
		</div>
		<?php endwhile; else: ?>
		<?php endif; ?>
	</div>
	<?php if( comments_open() ):?>
	<div class="commentcontent">
		<div class="title">
			<span class="title-border bd-purple"><i class="fas fa-comments"></i> Yorumlar</span>
			<span class="countcom"><?php comments_number('0 Yorum', '1 Yorum', '% Yorum' );?></span>   
		</div>
		<?php comments_template(); ?>  
	</div>
	<?php endif;?>
</div>
<?php get_footer(); ?>