<?php
/*
 * @ Decoder version : 1.0.0.2
 * @ cracked by X 
 */

if (file_exists(TEMPLATEPATH . "/lisans.php")) {
    require "lisans.php";
    $lisans["hash"] = ("WarezM");
    if ($lisans["hash"] !== $lisans_anahtar) {
        exit("Lisans anahtarınız bu site için geçerli değildir.");
    }
    unset($lisans);
    include_once "inc/filmplus.php";
    include_once "inc/features.php";
    include_once "inc/language.php";
    include_once "inc/anime-cpt.php";
    include_once "inc/anime-meta.php";
    include_once "inc/anime-episodes.php";
    include_once "inc/anime-generate.php";
    include_once "inc/anime-query.php";
    include_once "inc/legacy-migrate.php";
    include_once "inc/widgets.php";
    include_once "inc/install.php";
    add_action("init", "register_my_menus");
    add_action("init", "filmplus_register_anime_cpt", 0);
    add_action("init", "filmplus_register_anime_taxonomies", 0);
    // Homepage latest-feed listing scope (inc/anime-query.php): include anime
    // series, episodes, or both per the configured `filmplus_listing_scope`.
    add_action("pre_get_posts", "filmplus_listing_scope");
    // Route migrated legacy "Serisi" category requests to their `anime` entry
    // (inc/legacy-migrate.php, Requirement 9.5).
    add_action("template_redirect", "filmplus_maybe_route_legacy_series");
    // Anime meta boxes (inc/anime-meta.php).
    add_action("add_meta_boxes", "filmplus_register_anime_series_meta_box");
    add_action("add_meta_boxes", "filmplus_register_anime_episode_meta_box");
    add_action("add_meta_boxes", "filmplus_register_anime_download_meta_box");
    add_action("add_meta_boxes", "filmplus_register_anime_cast_meta_box");
    add_action("add_meta_boxes", "filmplus_remove_anime_tax_boxes", 99);
    // Inline "Generate Data" meta box + admin-post handler (inc/anime-generate.php).
    // The standalone Anime_Grabber import admin page (registered by the grabber
    // plugin) remains in place; this only adds the inline edit-screen flow.
    add_action("add_meta_boxes", "filmplus_register_anime_generate_meta_box");
    add_action("wp_ajax_filmplus_mal_fetch", "filmplus_anime_mal_fetch_ajax");
    add_action("wp_ajax_filmplus_mal_apply_media", "filmplus_anime_mal_apply_media_ajax");
    // Episode link validation runs before the episode save handler (priority 9
    // vs 10) so the previously stored ero_seri is still intact and can be
    // retained when the submitted value does not resolve to an anime entry.
    add_action("save_post", "filmplus_validate_episode_link", 9);
    add_action("save_post", "filmplus_save_anime_series_meta", 10);
    add_action("save_post", "filmplus_save_anime_episode_meta", 10);
    add_action("save_post", "filmplus_save_anime_download_meta", 10);
    add_action("save_post", "filmplus_save_anime_cast_meta", 10);
    add_action("admin_enqueue_scripts", "filmplus_enqueue_anime_cast_admin_assets");
    // Episode searchable-series picker (admin-ajax) + Big Cover image picker
    // assets, and removal of the legacy movie "Film Bilgileri" box now that the
    // platform is anime-only (inc/anime-meta.php).
    add_action("admin_enqueue_scripts", "filmplus_enqueue_anime_meta_admin_assets");
    add_action("wp_head", "filmplus_anime_head_styles");
    add_filter("comments_open", "filmplus_anime_force_comments_open", 10, 2);
    add_action("wp_ajax_filmplus_anime_series_search", "filmplus_anime_series_search_ajax");
    add_action("add_meta_boxes", "filmplus_remove_legacy_film_meta_box", 99);
    function register_my_menus()
    {
        register_nav_menus(["header-nav" => __("FilmPlus Header Menüsü")]);
    }
    register_sidebar(["name" => "Sidebar (En Üst)", "id" => "sidebar-ust", "before_widget" => "<div class=\"listcontent\">", "after_widget" => "</div>", "before_title" => "<div class=\"title\"><span class=\"title-border bd-purple\">", "after_title" => "</span></div>"]);
    register_sidebar(["name" => "Sidebar (En Alt)", "id" => "sidebar-alt", "before_widget" => "<div class=\"listcontent\">", "after_widget" => "</div>", "before_title" => "<div class=\"title\"><span class=\"title-border bd-purple\">", "after_title" => "</span></div>"]);
    register_sidebar(["name" => "Anasayfa (Son Eklenenler Üstü)", "id" => "anasayfa-ust", "before_widget" => "<div class=\"incontent\">", "after_widget" => "</div>", "before_title" => "", "after_title" => ""]);
    register_sidebar(["name" => "Anasayfa (Son Eklenenler Altı)", "id" => "anasayfa-alt", "before_widget" => "<div class=\"incontent\">", "after_widget" => "</div>", "before_title" => "", "after_title" => ""]);
    function filmplus_meta($isim, $alan, $sonra)
    {
        global $post;
        $ozel = get_post_meta($post->ID, "" . $alan . "", true);
        if ($ozel != "") {
            echo "<p><span>" . $isim . "</span>: " . $ozel . "</p>";
        } else {
            echo "" . $sonra . "";
        }
    }
    function filmplus_zaman($type = "post")
    {
        $d = "comment" == $type ? "get_comment_time" : "get_post_time";
        return human_time_diff($d("U"), current_time("timestamp")) . " " . __("önce", "filmplus");
    }
    function filmplus_resim_bulucu()
    {
        global $post;
        global $posts;
        $first_img = "";
        ob_start();
        ob_end_clean();
        $output = preg_match_all("/<img.+src=['\"]([^'\"]+)['\"][^>]*>/i", $post->post_content, $matches);
        if (!empty($output)) {
            $first_img = $matches[1][0];
        }
        $adres = get_bloginfo("template_url");
        if (empty($first_img)) {
            $first_img = $adres . "/images/no-thumbnail.png";
        }
        return $first_img;
    }
    function bilgi_part($args = "")
    {
        global $post;
        $bilgi = get_post_meta($post->ID, "kalite", true);
        if ($bilgi != "") {
            echo "<span class=\"bolumkalite\">" . $bilgi . "</span>";
        } else {
            echo "<span class=\"bolumkalite\">720p</span>";
        }
    }
    function filmplus_part_sistemi($args = "", $bilgi = NULL)
    {
        $defaults = ["before" => "" . __("" . $bilgi . ""), "after" => "", "link_before" => "<span>", "link_after" => "</span>", "echo" => 1];
        $r = wp_parse_args($args, $defaults);
        extract($r, EXTR_SKIP);
        global $page;
        global $numpages;
        global $multipage;
        global $more;
        global $pagenow;
        global $pages;
        $bilgi_bir = get_option("filmplus_part_bir");
        $output = "";
        if ($multipage) {
            $output .= $before;
            $i = 1;
            while ($i < $numpages + 1) {
                $part_content = $pages[$i - 1];
                $has_part_title = strpos($part_content, "<!--baslik:");
                if (0 === $has_part_title) {
                    $end = strpos($part_content, "-->");
                    $title = trim(str_replace("<!--baslik:", "", substr($part_content, 0, $end)));
                }
                $output .= " ";
                if ($i != $page || !$more && $page == 1) {
                    $output .= _wp_link_page($i);
                }
                $title = isset($title) && 0 < strlen($title) ? $title : "" . $bilgi_bir . "";
                $output .= $link_before . $title . $link_after;
                if ($i != $page || !$more && $page == 1) {
                    $output .= "</a>";
                }
                $i = $i + 1;
            }
            $output .= $after;
        }
        if ($echo) {
            echo $output;
        }
        return $output;
    }
    function filmplus_facebook()
    {
        $fb_resim = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "single-resim");
        $fb_resmim = get_post_meta(get_the_ID(), "resim", true);
        if (is_single()) {
            if (has_post_thumbnail()) {
                echo "<meta property=\"og:image\" content=\"" . $fb_resim[0] . "\" />";
            } else {
                if ($fb_resmim != "") {
                    echo "<meta property=\"og:image\" content=\"" . $fb_resmim . "\" />";
                } else {
                    echo "<meta property=\"og:image\" content=\"" . filmplus_resim_bulucu() . "\" />";
                }
            }
            echo "<meta property=\"og:title\" content=\"";
            wp_title("|", true, "right");
            bloginfo("name");
            echo "\" />\n<meta property=\"og:site_name\" content=\"";
            bloginfo("name");
            echo "\" />\n<meta property=\"og:url\" content=\"";
            the_permalink();
            echo "\" />\n";
        }
    }
    if (!function_exists("PozHtml_73_Advenced")) {
        function PozHtml_73_Advenced()
        {
            // The quicktags `edButtons` global only exists on the classic post
            // editor. Restrict this footer script to post.php / post-new.php so
            // it does not throw "edButtons is not defined" on other admin pages
            // (e.g. the Anime Grabber import screen).
            global $pagenow;
            if (!in_array($pagenow, array("post.php", "post-new.php"), true)) {
                return;
            }
            echo "        <script type=\"text/javascript\">\n\t\tedButtons[edButtons.length]=new edButton(\"ed_pfilmplus\",\"NextPage\",\"<!--nextpage-->\");\n\t\tedButtons[edButtons.length]=new edButton(\"ed_qfilmplus\",\"NextPage Başlık\",\"<!--baslik:\",\"-->\",\"qfilmplus\");\n        </script>\n    ";
        }
        add_action("admin_print_footer_scripts", "PozHtml_73_Advenced");
    }
} else {
    exit("Lisans anahtarının bulunduğundan emin olun.");
}

?>