<?php
/**
 * Anime episode sidebar (right column).
 *
 * Used by single.php for anime episode pages via get_sidebar('anime'). Renders,
 * top to bottom:
 *   1. the Season / Episode selector panel for the current episode,
 *   2. a "Popular Anime" list (recent anime entries),
 *   3. a "Genre Anime" list (genres taxonomy terms).
 *
 * @package FilmPlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="contentx">
	<div id="sidebax">

		<?php
		// 1. Season / Episode selector for the current episode.
		if ( function_exists( 'filmplus_episode_season_selector' ) ) {
			echo filmplus_episode_season_selector( get_the_ID() );
		}
		?>

		<?php
		// 2. Popular Anime (ranked widget).
		if ( function_exists( 'filmplus_popular_anime_widget' ) ) {
			echo filmplus_popular_anime_widget( 5 );
		}
		?>

		<?php
		// 3. Genre Anime — genres taxonomy terms.
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
