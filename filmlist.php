<?php
/**
 * Anime episode card (used on the homepage / archives listing of `post`).
 *
 * Each list item is an anime episode (post linked to a parent `anime` via
 * ero_seri). Badges are pulled from the parent anime: Type (TV/ONA/Movie),
 * Sub state, and a "COMPLETED" ribbon from status; the episode number comes
 * from the episode itself. Styling lives in filmplus_anime_head_styles().
 *
 * @package FilmPlus
 */

$fp_ep_id    = get_the_ID();
$fp_anime_id = (int) get_post_meta( $fp_ep_id, 'ero_seri', true );

$fp_type   = $fp_anime_id ? get_post_meta( $fp_anime_id, 'ero_type', true ) : '';
$fp_status = $fp_anime_id ? get_post_meta( $fp_anime_id, 'ero_status', true ) : '';
$fp_epnum  = get_post_meta( $fp_ep_id, 'ero_episodebaru', true );
$fp_sub    = get_post_meta( $fp_ep_id, 'ero_subepisode', true );
if ( '' === (string) $fp_sub && $fp_anime_id ) {
	$fp_sub = get_post_meta( $fp_anime_id, 'ero_sub', true );
}

// Poster: episode featured image, else parent anime featured/ero_image, else placeholder.
$fp_thumb = has_post_thumbnail( $fp_ep_id ) ? get_the_post_thumbnail_url( $fp_ep_id, 'medium' ) : '';
if ( ! $fp_thumb && $fp_anime_id ) {
	$fp_thumb = has_post_thumbnail( $fp_anime_id )
		? get_the_post_thumbnail_url( $fp_anime_id, 'medium' )
		: get_post_meta( $fp_anime_id, 'ero_image', true );
}
if ( ! $fp_thumb ) {
	$fp_thumb = get_template_directory_uri() . '/images/no-thumbnail.png';
}
?>
<div class="listmovie">
	<div class="movie-box anime-card">
		<a href="<?php the_permalink(); ?>">
			<div class="ac-poster">
				<?php if ( 'completed' === strtolower( (string) $fp_status ) ) : ?><span class="ac-ribbon">COMPLETED</span><?php endif; ?>
				<?php if ( '' !== (string) $fp_type ) : ?><span class="ac-type"><?php echo esc_html( $fp_type ); ?></span><?php endif; ?>
				<img src="<?php echo esc_url( $fp_thumb ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" />
				<span class="ac-play"><i class="fas fa-play-circle"></i></span>
				<div class="ac-badges">
					<span class="ac-eps"><?php echo ( '' !== (string) $fp_epnum ) ? 'Eps ' . esc_html( $fp_epnum ) : ''; ?></span>
					<?php if ( '' !== (string) $fp_sub && 'None' !== (string) $fp_sub ) : ?><span class="ac-sub"><?php echo esc_html( $fp_sub ); ?></span><?php endif; ?>
				</div>
			</div>
			<div class="film-ismi"><?php the_title(); ?></div>
		</a>
	</div>
</div>
