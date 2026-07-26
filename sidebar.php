<?php
/**
 * Global sidebar — anime-oriented (Popular Anime + Genre Anime).
 *
 * Replaces the old movie sidebar (Film Türleri / Movies by Year) now that the
 * platform is anime-only. Episode pages use sidebar-anime.php which prepends a
 * Season/Episode selector before these same lists.
 *
 * @package FilmPlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="mobil-sidebar"><i class="fa fa-hashtag"></i></div>
<div id="contentx">
	<div id="sidebax">
		<?php if ( is_active_sidebar( 'sidebar-ust' ) ) { dynamic_sidebar( 'sidebar-ust' ); } ?>

		<?php
		// Popular Anime (ranked widget: rank, thumb, genres, score).
		if ( function_exists( 'filmplus_popular_anime_widget' ) ) {
			echo filmplus_popular_anime_widget( 5 );
		}
		?>

		<?php
		// Genre Anime.
		$fp_genres = get_terms(
			array(
				'taxonomy'   => 'genres',
				'hide_empty' => false,
				'orderby'    => 'name',
				'order'      => 'ASC',
			)
		);
		if ( ! empty( $fp_genres ) && ! is_wp_error( $fp_genres ) ) :
		?>
		<div class="listcontent">
			<div class="title">
				<span class="title-border bd-purple"><i class="fas fa-bars"></i> <?php echo esc_html( function_exists( 'filmplus_anime_label' ) ? filmplus_anime_label( 'filmplus_anime_genre_menu', 'Genre Anime' ) : 'Genre Anime' ); ?></span>
			</div>
			<ul id="listulx" class="custom-scrollbar">
				<?php foreach ( $fp_genres as $fp_term ) : ?>
					<li><a href="<?php echo esc_url( get_term_link( $fp_term ) ); ?>"><?php echo esc_html( $fp_term->name ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-alt' ) ) { dynamic_sidebar( 'sidebar-alt' ); } ?>
	</div>
</div>
