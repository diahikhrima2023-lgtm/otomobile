<?php
/*
Template Name: Profil Düzenle
*/
$current_user = wp_get_current_user();
if( !is_user_logged_in() ) {
	wp_redirect( home_url() );
	exit;
}
get_header();   
?>  
<div id="content">
    <div class="iletisimalani">
        <div class="title">
            <h1 class="title-border bd-purple"><i class="fa fa-edit"></i> <?php the_title(); ?></h1>
        </div>
        <div class="editicerik">
            <div class="alert alert-type-2 alert-info">
                <div class="alert-icon"><i class="fa fa-exclamation-circle"></i></div>
                <div class="alert-desc">
                    <p class="alert-title full-width"><?php echo filmplus_avatar_degisikligi;?></p>
                    <div class="alert-desc2"><?php echo filmplus_avatar_aciklama;?> <a href="https://gravatar.com" target="_blank">Gravatar.com</a> <?php echo filmplus_avatar_aciklama2;?></div>
                </div>
            </div>
            <li class="update-message" style="display:none"></li>
            <script src='https://www.google.com/recaptcha/api.js'></script>
            <div id="form-wrapper">
                <div id="error-message" style="display:none"></div>
                <form method="post" name="up-update-form" id="adduser">
                    <div id="titleortala">
                        <div class="title"> <span class="title-border bd-green"><i class="fas fa-info-circle"></i> <?php echo filmplus_kisisel_bilgiler;?></span> </div>
                    </div>
                    <div class="field">
                        <label><?php echo filmplus_kullanici_adi;?></label>
                        <input type="text" autocomplete="off" name="username" id="up-username" value="<?php the_author_meta( 'user_login', $current_user->ID ); ?>" disabled/>
                    </div>
                    <div class="field">
                        <label><?php echo filmplus_email_adresi;?></label>
                        <input type="text" name="email" id="up-email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" autocomplete="off" />
                    </div>
                    <div class="field">
                        <label><?php echo filmplus_ad;?></label>
                        <input type="text" autocomplete="off" name="fname" id="up-fname" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" />
                    </div>
                    <div class="field">
                        <label><?php echo filmplus_soyad;?></label>
                        <input type="text" autocomplete="off" name="lname" id="up-lname" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" />
                    </div>
                    <div class="field">
                        <label><?php echo filmplus_kendinden_bahset;?></label>
                        <textarea name="abuot" id="up-about" autocomplete="off" placeholder="<?php echo filmplus_kendini_anlat;?>"><?php the_author_meta( 'description', $current_user->ID ); ?></textarea>
                    </div>
                    <div id="titleortala">
                        <div class="title"> <span class="title-border bd-blue"><i class="fas fa-globe"></i> <?php echo filmplus_sosyal_hesaplar;?></span> </div>
                    </div>
                    <div class="field">
                        <label><?php echo filmplus_facebook_kullanici;?></label>
                        <input type="text" autocomplete="off" placeholder="@kullaniciadi" name="fb" id="up-fb" value="<?php the_author_meta( 'facebook', $current_user->ID ); ?>" />
                    </div>
                    <div class="field">
                        <label><?php echo filmplus_twitter_kullanici;?></label>
                        <input type="text" autocomplete="off" placeholder="@kullaniciadi" name="tw" id="up-tw" value="<?php the_author_meta( 'twitter', $current_user->ID ); ?>" />
                    </div>
                    <div class="field">
                        <label><?php echo filmplus_instagram_kullanici;?></label>
                        <input type="text" autocomplete="off" placeholder="@kullaniciadi" name="in" id="up-in" value="<?php the_author_meta( 'instagram', $current_user->ID ); ?>" />
                    </div>
                    <div id="titleortala">
                        <div class="title"> <span class="title-border bd-purple"><i class="fas fa-key"></i> <?php echo filmplus_parola_degistir;?></span> </div>
                    </div>
                    <div class="field">
                        <label><?php echo filmplus_parolaniz;?></label>
                        <input type="password" name="password" id="up-psw" />
                    </div>
                    <div class="field">
                        <label><?php echo filmplus_parolaniz_tekrar;?></label>
                        <input type="password" name="password2" id="up-psw2" />
                    </div>
                    <div class="field">
                        <div style="margin-left:15px;margin-bottom: 18px; float: left;" class="g-recaptcha" data-sitekey="<?php echo get_option(" filmplus_site_key ");?>"></div>
                    </div>
                    <div class="frm-button">
                        <input type="button" id="update-me" value="<?php echo filmplus_profili_guncelle;?>" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>