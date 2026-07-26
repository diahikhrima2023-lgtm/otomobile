<?php
/*
Template Name: Türkçe Dublaj Filmler
*/
get_header();
$obj_id = get_queried_object_id();
$current_url = get_permalink( $obj_id );
if(isset($_GET["sirala"]) && $_GET["sirala"] == "imdb") {
	$key= 'imdb';
	$orderby= 'meta_value_num';
	$order_text = filmplus_imdb_puanina_gore;
}
elseif(isset($_GET["sirala"]) && $_GET["sirala"] == "begeni") { 
	$key= 'pld_like_count';
	$orderby= 'meta_value_num';
	$order_text = filmplus_begeni_sayisina_gore;
}
elseif(isset($_GET["sirala"]) && $_GET["sirala"] == "izlenme") { 
	$key='views';
	$orderby='meta_value_num';
	$order_text = filmplus_izlenme_sayisina_gore;
}
elseif(isset($_GET["sirala"]) && $_GET["sirala"] == "yorum") { 
	$key = '';
	$orderby = 'comment_count';
	$order_text = filmplus_yorum_sayisina_gore;
}
else {
	$key = '';
	$orderby = 'date';
	$order_text = filmplus_sirala;
}
if(isset($_GET["sirala"])) { 
	$remove = '<span class="category-remove"><a href="'.$current_url.'">×</a></span>';
}
else {
	$remove = '';
}
?>
<div id="content">
	<div class="incontent">
		<div class="title">
			<h1 class="title-border bd-purple"><i class="fa fa-play-circle"></i> <?php the_title();?></h1>
			<div class="sirala">
				<span class="kategori-sirala"><?php echo $order_text;?> <i class="fas fa-sort"></i></span>
				<?php echo $remove;?>
				<ul class="filter-menu">
					<li><a href="<?php echo $current_url;?>?sirala=imdb"><i class="fas fa-star"></i> <?php echo filmplus_imdb_puanina_gore;?></a></li>
					<li><a href="<?php echo $current_url;?>?sirala=izlenme"><i class="far fa-eye"></i> <?php echo filmplus_izlenme_sayisina_gore;?></a></li>
					<li><a href="<?php echo $current_url;?>?sirala=begeni"><i class="fas fa-thumbs-up"></i> <?php echo filmplus_begeni_sayisina_gore;?></a></li>
					<li><a href="<?php echo $current_url;?>?sirala=yorum"><i class="fas fa-comments"></i> <?php echo filmplus_yorum_sayisina_gore;?></a></li>
				</ul>
			</div>
		</div>
		<div id="listehizala">
		<?php
		$args = array(
					'paged' => get_query_var('paged'),
					'posts_per_page' => get_option('filmplus_sayfa_basi'),
					'orderby' => $orderby,
					'order' => 'DESC',
					'ignore_sticky_posts'=>1,
					'meta_key' => $key,
					'meta_query' => array(
					array(
						'key' => 'dil',
						'value' => 'Dublaj',
						'compare' => 'LIKE' 
						)
					)
				);
		query_posts($args);
		?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php include (TEMPLATEPATH . '/filmlist.php');?>
		<?php endwhile; else: ?>
		<div id="bulunamadi"><?php echo filmplus_film_bulunamadi;?></div>
		<?php endif; ?>
		</div>
		<div class="sayfalama"><?php filmplus_sayfalama();?></div>
	</div>
    <?php get_sidebar();?>
</div>
<?php get_footer();?>