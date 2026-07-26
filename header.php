<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<?php filmplus_metatags();?>
<title><?php filmplus_titles(); ?></title>
<?php filmplus_description(); ?>
<?php filmplus_keywords(); ?>
<?php filmplus_canonical();?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> &raquo; Beslemesi" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> &raquo; Yorum Beslemesi" href="<?php bloginfo('comments_rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php filmplus_stylesheet();?>
<?php if(get_option('filmplus_favicon')) { ?>
<link rel="shortcut icon" href="<?php echo get_option('filmplus_favicon'); ?>" />
<?php } else { ?>
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/fav.ico" />
<?php } ?>
<?php if(get_option('filmplus_seo_facebook') == 'On') { filmplus_facebook(); } ?>
<?php wp_head(); ?>
<?php if(get_option('filmplus_r_e') == 'On') { include(TEMPLATEPATH . '/splash.php'); } ?>
<?php if(get_option('filmplus_analytics')) { echo get_option('filmplus_analytics'); }?>
</head>
<body>
<?php if(get_option('filmplus_r_ps') == 'On'): ?>
<?php pageskin_reklam();?>
<?php endif; ?>
	<div id="wrap">
		<div id="header">
			<div class="headerleft">
				<?php if(get_option('filmplus_logo')) { ?>
				<a href="<?php echo get_option('home'); ?>"><img src="<?php echo get_option('filmplus_logo'); ?>" alt="<?php bloginfo('name'); ?>" /></a>
				<?php } else { ?>
				<a class="logo" href="<?php echo get_option('home'); ?>"><?php echo get_option('filmplus_logo_title'); ?></a>
				<?php } ?>	
			</div>
			<div class="headerright">
				<?php if (is_page(get_option('filmplus_arsiv_page_id'))):?>
				<div id="mobil-filter"><i class="fas fa-filter"></i></div>
				<?php endif;?>
				<?php if(is_user_logged_in()) { ?>
				<a href="<?php echo get_option('siteurl'); ?>/profil/<?php global $current_user; wp_get_current_user(); echo $current_user->user_nicename;?>" class="small-button"><i class="fas fa-user fa-fw"></i> <div class="nomob"><?php echo filmplus_profilim; ?></div></a>
				<a href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>" class="small-button"><i class="fas fa-sign-out-alt"></i> <div class="nomob"><?php echo filmplus_cikis; ?></div></a>
				<?php } /* Streaming-only: login & sign-up entry points hidden for guests. */ ?>
			</div>
			<ul class="topnav" id="myTopnav">
				<?php if ( has_nav_menu( 'header-nav' ) ) : ?>
				<?php wp_nav_menu(array('theme_location' => 'header-nav', 'depth' => 3, 'container' => false)); ?>
				<?php endif; ?>
				<a href="javascript:void(0);" class="icon" onclick="navmenufunc()">
					<i class="fas fa-bars"></i>
				</a>
				<li>
					<form method="get" class="example" action="<?php echo esc_url( home_url( '/' ) );?>" autocomplete="off">
						<input type="text" class="field" name="s" id="searchInput" onkeyup="fetchResults()" placeholder="<?php echo filmplus_arama_metin; ?>">
						<button type="submit"><i class="fa fa-search"></i></button>
						<div id="datafetch"></div>
					</form>
				</li>
			</ul>
		</div>
		<?php if(get_option('filmplus_r_h') == 'On'): ?>
		<div class="headerad"><center><?php echo get_option('filmplus_r_h_h'); ?></center></div>
		<?php endif; ?>