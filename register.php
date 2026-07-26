<?php
/*
Template Name: Üye Ol Sayfası
*/
if( is_user_logged_in() ) {
	wp_redirect( home_url() );
	exit;
}
get_header();   
?>  
<div id="content">
    <div class="iletisimalani">
        <div class="title">
            <h1 class="title-border bd-purple"><i class="fas fa-user-plus"></i> <?php the_title(); ?></h1>
        </div>
        <div class="inpage">
            <li class="register-message" style="display:none"></li>
            <script src='https://www.google.com/recaptcha/api.js'></script>
            <div id="form-wrapper">
                <div id="error-message" style="display:none"></div>
                <form method="post" id="register" name="register-form">
                    <div class="field">
                        <input placeholder="<?php echo filmplus_kullanici_adi;?>*" type="text" autocomplete="off" name="username" id="username" required />
                    </div>
                    <div class="field">
                        <input placeholder="<?php echo filmplus_email_adresi;?>*" type="email" autocomplete="off" name="mail" id="email" required />
                    </div>
                    <div class="field">
                        <input placeholder="<?php echo filmplus_parolaniz;?>" type="password" name="password" id="psw" required />
                    </div>
                    <div class="field">
                        <input placeholder="<?php echo filmplus_parolaniz_tekrar;?>" type="password" name="password2" id="psw2" required />
                    </div>
                    <div class="field">
                        <input placeholder="<?php echo filmplus_ad;?>" type="text" autocomplete="off" name="fname" id="fname" />
                    </div>
                    <div class="field">
                        <input placeholder="<?php echo filmplus_soyad;?>" type="text" autocomplete="off" name="lname" id="lname" />
                    </div>
                    <div class="field">
                        <div style="display: inline-block !important;margin-bottom: 18px;" class="g-recaptcha" data-sitekey="<?php echo get_option(" filmplus_site_key ");?>"></div>
                    </div>
                    <div class="frm-button">
                        <input type="submit" id="register-me" value="<?php echo filmplus_kayit_ol;?>" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>