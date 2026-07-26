<?php
/*
Template Name: Film Arşivi
*/
get_header();
$args = array( 'parent' => 0, 'hide_empty' => 0 );
$categories = get_categories( $args );
?>
<div id="content">
	<div class="incontent">
		<div class="title">
			<h1 class="title-border bd-purple"><i class="fas fa-archive"></i> <?php the_title(); ?></h1>
		</div>
		<div class="container">
			<?php if($_GET):?>
				<?php
				$key = '';
				$orderby = '';
				if(isset($_GET['filtrele']) && $_GET['filtrele'] == 'imdb') {
					$s1 = "selected";$key= 'imdb';$orderby='meta_value_num';
				} 
				elseif(isset($_GET['filtrele']) && $_GET['filtrele'] == 'like')  {
					$s3 = "selected";$key= 'pld_like_count';$orderby='meta_value_num';
				}
				elseif(isset($_GET['filtrele']) && $_GET['filtrele'] == 'views') {
					$s2 = "selected";$key='views';$orderby='meta_value_num';
				}
				elseif(isset($_GET['filtrele']) && $_GET['filtrele'] == 'comment_count') {
					$s4 = "selected";$key='';$orderby=$_GET['filtrele'];
				}
				elseif(isset($_GET['filtrele']) && $_GET['filtrele'] == 'date') {
					$s5 = "selected";$key='';$orderby=$_GET['filtrele'];
				}
				elseif(isset($_GET['filtrele']) && $_GET['filtrele'] == 'name') {
					$s6 = "selected";$key='';$orderby=$_GET['filtrele'];
				}
				if(isset($_GET['sirala']) && $_GET['sirala'] == 'DESC'){
					$ss1="selected";
				}
				elseif(isset($_GET['sirala']) && $_GET['sirala'] == 'ASC'){
					$ss2="selected";
				}
				if(isset($_GET['tur'])){
					$tur = $_GET['tur'];					}
				else{
					$tur = "";
				}
				if(isset($_GET['kelime'])){
					$kelime = esc_html($_GET['kelime']);
				}
				else{
					$kelime = "";
				}
				if(isset($_GET['sirala'])){
					$sirala = $_GET['sirala'];
				}
				else{
					$sirala = "";
				}
				if(isset($_GET['imdb'])){
					$imdb = $_GET['imdb'];
				}
				else{
					$imdb = "";
				}
				if(isset($_GET['dil']) && $_GET['dil'] == "Turkce Altyazili"){
					$value = array('Turkce Altyazi-Dublaj','Turkce Altyazi');
					$compare = 'IN';
				} 
				elseif(isset($_GET['dil']) && $_GET['dil'] == "Turkce Dublaj"){
					$value = array('Turkce Altyazi-Dublaj','Turkce Dublaj');
					$compare = 'IN';
				}
				elseif(isset($_GET['dil']) && $_GET['dil'] == "Yerli Film"){
					$value = array('Yerli Film');
					$compare = 'IN';
				}
				else{
					$value = "";
					$compare = "LIKE";
				}
				$args = array(
					'paged' => get_query_var('paged'),
					'category_name' => $tur,
					'posts_per_page' => get_option('filmplus_sayfa_basi'),
					'meta_key' => $key,
					's' => $kelime,
					'orderby' => $orderby,
					'order' => $sirala,
					'meta_query' => array(
						array(
							'key'     => 'imdb',     
							'value'   => $imdb, 
							'compare' => '>=', 
						),
						array(
							'key'     => 'dil',     
							'value'   => $value, 
							'compare' => $compare, 
						)
					)
				);
				if (!empty($_GET['yil'])) {
					$args['tax_query'] = array(
						array (
							'taxonomy' => 'yil',
							'field' => 'slug',
							'terms' => $_GET['yil'],
						)
					);
				}
				$query = query_posts($args);
				if(have_posts()) :
					while (have_posts()) : the_post(); 
						include (TEMPLATEPATH . '/filmlist.php');
					endwhile;
				else :
					echo '<div id="bulunamadi">'.filmplus_film_bulunamadi.'</div>';
				endif;
				?>
			<?php else:?>
				<?php query_posts(array('paged' => get_query_var('paged'), 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => get_option('filmplus_sayfa_basi'), 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'post_type' => 'post'));?>
				<?php if(have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>        
						<?php include (TEMPLATEPATH . '/filmlist.php');?>
					<?php endwhile; ?>    
				<?php endif; ?>
			<?php endif; ?>
			<div class="sayfalama"><?php filmplus_sayfalama();?></div>
		</div>
	</div>
	<form action="<?php echo get_permalink(get_option('filmplus_arsiv_page_id')) ?>" method="get" id="filter">
		<div class="title" style="margin-bottom: 15px;">
			<span class="title-border bd-purple"><i class="fas fa-filter"></i> <?php echo filmplus_filtrele;?></span>
			<span class="totalfilm"><?php echo wp_count_posts()->publish; ?> <?php echo filmplus_film;?></span>
		</div>
		<label class="filterlabel" style="width: auto;">
			<select class="nameclass filterselect" style="width:164px" name="filtrele">
				<option value="imdb" <?php if(isset($s1)) echo $s1;?>><?php echo filmplus_imdb_puanina_gore;?></option>
				<option value="views" <?php if(isset($s2)) echo $s2;?>><?php echo filmplus_izlenmeye_gore;?></option>
				<option value="like" <?php if(isset($s3)) echo $s3;?>><?php echo filmplus_begeniye_gore;?></option>
				<option value="comment_count" <?php if(isset($s4)) echo $s4;?>><?php echo filmplus_yoruma_gore;?></option>
				<option value="date" <?php if(isset($s5)) echo $s5;?>><?php echo filmplus_eklenmeye_gore;?></option>
				<option value="name"<?php if(isset($s6)) echo $s6;?>><?php echo filmplus_alfabetik;?></option>
			</select>
		</label>
		<label class="filterlabel" style="width: auto;float: right;">
			<select class="nameclass filterselect" name="sirala">
				<option value="DESC" <?php if(isset($ss1)) echo $ss1;?>>Z-A / 9-0</option>
				<option value="ASC" <?php if(isset($ss2)) echo $ss2;?>>A-Z / 0-9</option>
			</select>
		</label>
		<span class="filtertag"><?php echo filmplus_min_imdb;?></span>  
		<label><input placeholder="Örn: 7" type="number" name="imdb" value="<?php if(isset($_GET['imdb'])) echo $_GET['imdb'];?>" /></label>
		<span class="filtertag"><?php echo filmplus_film_adi;?></span>  
		<label><input placeholder="Örn: Yenilmezler" type="text" name="kelime" value="<?php if(isset($_GET['kelime'])) echo esc_html($_GET['kelime']);?>"/></label>
		<span class="filtertag"><?php echo filmplus_dil;?></span>  
		<label>
			<select class="nameclass" id="dil" name="dil">
				<option value=""><?php echo filmplus_tum_diller;?></option>
				<option value="Turkce Dublaj"><?php echo filmplus_turkce_dublaj;?></option>
				<option value="Turkce Altyazili"><?php echo filmplus_turkce_altyazili;?></option>
				<option value="Yerli Film"><?php echo filmplus_yerli_film;?></option>
			</select>
		</label>
		<span class="filtertag"><?php echo filmplus_yapim_yili;?></span>  
		<label>
			<select class="nameclass" id="yil" name="yil">
				<option value=""><?php echo filmplus_tum_yillar;?></option>
				<?php
				$terms = get_terms(
					array(
						'taxonomy'   => 'yil',
						'hide_empty' => false,
						'orderby' => 'name',
						'order' => 'DESC'
					)
				);
				if ( ! empty( $terms ) && is_array( $terms ) ) {
					foreach ( $terms as $term ) { ?>
						<option value="<?php echo $term->name; ?>"><?php echo $term->name; ?></option>
					<?php
					}
				} 
				?>
			</select>
		</label>
		<span class="filtertag"><?php echo filmplus_kategori;?></span>  
		<div id="category-button">
			<?php
			$args5 = array(
				'name__like'  => 'Serisi',
			);
			$ids = array();
			$categories = get_categories( $args5 );
			if(get_categories($args5)){
				foreach ( $categories as $category ) {
					array_push($ids, $category->term_id);
				}
			}
			array_push($ids,1);
			$ids_str = implode(",", $ids);
			$args = array(
				'orderby' => 'name',
				'order' => 'ASC',
				'parent' => 0,
				'hide_empty' => 0,
				'exclude'  => $ids_str,
			);
			$categories = get_categories( $args );
			foreach ( $categories as $category ) {
			?>
				<?php if(isset($_GET['tur']) && $category->name == $_GET['tur']):?>
				<label>
					<input type="checkbox" value="<?php echo $category->name;?>" name="tur" checked><span><?php echo $category->name;?></span>
				</label>
				<?php else:?>
				<label>
					<input type="checkbox" value="<?php echo $category->name;?>" name="tur"><span><?php echo $category->name;?></span>
				</label>
				<?php endif;?>
			<?php
			}
			?> 
		</div>
		<button type="submit"><i class="fas fa-filter"></i> <?php echo filmplus_filmleri_getir;?></button>
	</form>
</div>
<script>
document.getElementById('yil').value = "<?php if(isset($_GET['yil'])) echo $_GET['yil'];?>";
document.getElementById('dil').value = "<?php if(isset($_GET['dil'])) echo $_GET['dil'];?>";
$(document).ready(function() {
	$('input[type="checkbox"]').on('change', function() {
		$('input[type="checkbox"]').not(this).prop('checked', false);
	});
});
</script>
<?php get_footer(); ?>