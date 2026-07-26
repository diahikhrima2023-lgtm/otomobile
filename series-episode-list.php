<?php
/**
 * Series episode list partial.
 *
 * Renders the ordered episode list for a given anime series, reusing the
 * ordering helper `filmplus_anime_episodes( $anime_id )` (inc/anime-episodes.php),
 * which returns the linked episode `post`s ordered by episode number ascending
 * with creation date ascending as the secondary key (Requirement 3.4).
 *
 * The partial is reusable by both the series page (single-anime.php) and the
 * episode pages (single.php). It is included the same way as other theme
 * partials, e.g. `include( TEMPLATEPATH . '/series-episode-list.php' );`.
 *
 * Callers MAY set the following variables in scope before including the file:
 *
 *   - $filmplus_episode_list_anime_id  int   Parent anime entry ID whose
 *                                            episodes should be listed. When
 *                                            unset, the partial falls back to
 *                                            the current post ID (correct on a
 *                                            single-anime.php series page).
 *   - $filmplus_episode_list_current   int   Episode post ID to mark as the
 *                                            currently active item (used by
 *                                            episode pages, Requirement 4.2).
 *
 * @package FilmPlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

// Resolve the target series ID: explicit caller value first, then the current
// post (so a series page can include the partial without passing anything).
$filmplus_el_anime_id = isset( $filmplus_episode_list_anime_id )
	? absint( $filmplus_episode_list_anime_id )
	: ( function_exists( 'get_the_ID' ) ? absint( get_the_ID() ) : 0 );

// The ordering helper lives in inc/anime-episodes.php; guard in case the
// partial is reached before the theme bootstrap requires it.
$filmplus_el_episodes = ( $filmplus_el_anime_id > 0 && function_exists( 'filmplus_anime_episodes' ) )
	? filmplus_anime_episodes( $filmplus_el_anime_id )
	: array();

// Episode currently being viewed (episode pages), highlighted in the list.
$filmplus_el_current = isset( $filmplus_episode_list_current )
	? absint( $filmplus_episode_list_current )
	: 0;

if ( ! empty( $filmplus_el_episodes ) ) :
	$filmplus_el_heading = get_the_title( $filmplus_el_anime_id ) . ' ' . ( function_exists( 'filmplus_anime_label' )
		? filmplus_anime_label( 'filmplus_anime_episode_list_suffix', 'Episode List' )
		: 'Episode List' );
	?>
	<div class="series-episode-list">
		<div class="title">
			<span class="title-border bd-purple"><i class="fas fa-list-ol"></i> <?php echo esc_html( $filmplus_el_heading ); ?></span>
		</div>
		<ul class="episode-list">
			<?php foreach ( $filmplus_el_episodes as $filmplus_el_episode ) : ?>
				<?php
				$filmplus_el_id     = (int) $filmplus_el_episode->ID;
				$filmplus_el_number = get_post_meta( $filmplus_el_id, 'ero_episodebaru', true );
				$filmplus_el_link   = get_permalink( $filmplus_el_id );
				$filmplus_el_active = ( $filmplus_el_current > 0 && $filmplus_el_current === $filmplus_el_id );

				// Per-episode title and subtitle-state badge display decision
				// (Requirement 19.6): show ero_episodetitle when present, show
				// the ero_subepisode badge when it is not "None". Falls back to
				// the post title when no explicit episode title is stored.
				$filmplus_el_eptitle = get_post_meta( $filmplus_el_id, 'ero_episodetitle', true );
				$filmplus_el_substate = get_post_meta( $filmplus_el_id, 'ero_subepisode', true );
				$filmplus_el_display = function_exists( 'filmplus_anime_episode_list_item_display' )
					? filmplus_anime_episode_list_item_display( $filmplus_el_eptitle, $filmplus_el_substate )
					: array(
						'title'      => (string) $filmplus_el_eptitle,
						'show_title' => '' !== (string) $filmplus_el_eptitle,
						'sub'        => (string) $filmplus_el_substate,
						'show_sub'   => '' !== (string) $filmplus_el_substate && 'None' !== (string) $filmplus_el_substate,
					);
				$filmplus_el_title = $filmplus_el_display['show_title']
					? $filmplus_el_display['title']
					: get_the_title( $filmplus_el_id );
				?>
				<li class="episode-item<?php echo $filmplus_el_active ? ' is-active' : ''; ?>">
					<a href="<?php echo esc_url( $filmplus_el_link ); ?>"<?php echo $filmplus_el_active ? ' aria-current="page"' : ''; ?>>
						<?php if ( '' !== (string) $filmplus_el_number ) : ?>
							<span class="episode-number"><?php echo esc_html( $filmplus_el_number ); ?></span>
						<?php endif; ?>
						<span class="episode-title"><?php echo esc_html( $filmplus_el_title ); ?></span>
						<?php if ( $filmplus_el_display['show_sub'] ) : ?>
							<span class="episode-sub"><?php echo esc_html( $filmplus_el_display['sub'] ); ?></span>
						<?php endif; ?>
						<span class="episode-date"><?php echo esc_html( function_exists( 'filmplus_id_date_for_post' ) ? filmplus_id_date_for_post( $filmplus_el_id ) : '' ); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
endif;

// Clean up the loop scratch variables so the including template's scope is not
// polluted with partial-internal state.
unset(
	$filmplus_el_anime_id,
	$filmplus_el_episodes,
	$filmplus_el_current,
	$filmplus_el_heading,
	$filmplus_el_episode,
	$filmplus_el_id,
	$filmplus_el_number,
	$filmplus_el_link,
	$filmplus_el_title,
	$filmplus_el_active,
	$filmplus_el_eptitle,
	$filmplus_el_substate,
	$filmplus_el_display
);
