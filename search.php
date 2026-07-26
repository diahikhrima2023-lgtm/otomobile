<?php get_header();
$q1 = get_posts(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => '-1',
    's' => get_search_query()
));
$q2 = get_posts(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => '-1',
    'meta_query' => array(
        array(
           'key' => 'filmadi',
           'value' => get_search_query(),
           'compare' => 'LIKE'
        )
     )
));
$merged = array_merge( $q1, $q2 );
$post_ids = array();
foreach( $merged as $item ) {
    $post_ids[] = $item->ID;
}
$unique = array_unique($post_ids);
if(!$unique){
    $unique=array('0');
}
$args = array(
    'post_type' => 'post',
    'posts_per_page' => '18',
    'post__in' => $unique,
    'paged' => get_query_var('paged'),
);
$the_query = new WP_Query($args);?>
<div id="content">
	<?php if( $the_query->have_posts() ) : ?>
	<div class="searchcontent">
		<div class="title">
			<h1 class="title-border bd-purple"><i class="fa fa-search"></i> <?php echo filmplus_arama_sonuclari;?> : (<?php the_search_query(); ?>)</h1>  
		</div>
		<div id="listehizala">
			<?php while( $the_query->have_posts() ): $the_query->the_post() ?>
			<?php include (TEMPLATEPATH . '/filmlist.php'); ?>
			<?php endwhile ?>
		</div>
		<div class="sayfalama"><?php filmplus_sayfalama();?></div>
	</div>
	<?php else : ?>
	<div class="incontent">
		<div class="title">
			<h1 class="title-border bd-purple"><i class="fa fa-search"></i> <?php echo filmplus_film_yok;?></h1>  
		</div>
		<p style="margin-left:8px;color:#cccccc;font-size: 13px;"><?php echo filmplus_aradiginiz_kelime;?> "<strong><?php the_search_query(); ?></strong>" <?php echo filmplus_arsivde_yok;?></p>
	</div>
	<?php endif; ?>
</div>
<?php get_footer(); ?>