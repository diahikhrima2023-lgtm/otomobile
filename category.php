<?php get_header();
$kategori = get_queried_object();
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
	$remove = '<span class="category-remove"><a href="'.get_category_link($kategori->term_id).'">×</a></span>';
}
else {
	$remove = '';
}
?>
<div id="content">
	<div class="incontent">
		<div class="title">
			<h1 class="title-border bd-purple"><i class="fa fa-play-circle"></i> <?php echo single_cat_title().get_option('filmplus_seo_index_add_cat'); ?></h1>
			<div class="sirala">
				<span class="kategori-sirala"><?php echo $order_text;?> <i class="fas fa-sort"></i></span>
				<?php echo $remove;?>
				<ul class="filter-menu">
					<li><a href="<?php echo get_category_link($kategori->term_id);?>?sirala=imdb"><i class="fas fa-star"></i> <?php echo filmplus_imdb_puanina_gore;?></a></li>
					<li><a href="<?php echo get_category_link($kategori->term_id);?>?sirala=izlenme"><i class="far fa-eye"></i> <?php echo filmplus_izlenme_sayisina_gore;?></a></li>
					<li><a href="<?php echo get_category_link($kategori->term_id);?>?sirala=begeni"><i class="fas fa-thumbs-up"></i> <?php echo filmplus_begeni_sayisina_gore;?></a></li>
					<li><a href="<?php echo get_category_link($kategori->term_id);?>?sirala=yorum"><i class="fas fa-comments"></i> <?php echo filmplus_yorum_sayisina_gore;?></a></li>
				</ul>
			</div>
		</div>
		<div id="listehizala">
		<?php
		$args = array(
					'paged' => get_query_var('paged'),
					'posts_per_page' => get_option('filmplus_sayfa_basi'),
					'category__in' => $kategori->term_id,
					'orderby' => $orderby,
					'order' => 'DESC',
					'ignore_sticky_posts'=>1,
					'meta_key' => $key
				);
		$my_query = new wp_query($args);
		?>
		<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
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