<aside class="buddypanel">
    <?php
    $menu = is_user_logged_in() ? 'buddypanel-loggedin' : 'buddypanel-loggedout';
    $header = nightingale_buddyboss_theme_get_option( 'buddyboss_header' );

    if ( $header == '3' && !buddypanel_is_learndash_inner() ) {

        get_template_part( 'template-parts/site-logo' );

    } elseif ( $header == '3' && buddypanel_is_learndash_inner() ) { ?>

        <header class="panel-head">
			<a href="#" class="bb-toggle-panel"><i class="bb-icon-menu-left"></i></a>
		</header>

        <?php
        if ( buddyboss_is_learndash_brand_logo() && buddyboss_theme_ld_focus_mode() ) { ?>
            <div class="site-branding ld-brand-logo"><img src="<?php echo esc_url(wp_get_attachment_url(buddyboss_is_learndash_brand_logo())); ?>" alt="<?php echo esc_attr(get_post_meta(buddyboss_is_learndash_brand_logo() , '_wp_attachment_image_alt', true)); ?>"></div>
        <?php } else {
            get_template_part( 'template-parts/site-logo' );
        }

    } else { ?>

        <header class="panel-head">
			<a href="#" class="bb-toggle-panel"><i class="bb-icon-menu-left"></i></a>
		</header>

    <?php } ?>

	<div class="side-panel-inner">
        <div class="side-panel-menu-container">
    		<?php
    		wp_nav_menu( array(
    			'theme_location' => $menu,
    			'menu_id'		 => 'buddypanel-menu',
    			'container'		 => false,
    			'fallback_cb'	 => '',
    			'walker'         => new BuddyBoss_BuddyPanel_Menu_Walker(),
    			'menu_class'	 => 'buddypanel-menu side-panel-menu', )
    		);
    		?>
        </div>
	</div>
</aside>
