<?php
/**
 * BP Nouveau Component's directory nav template.
 *
 * @since   3.0.0
 * @version 3.0.0
 */

if ( ( bp_nouveau_has_nav( array( 'object' => 'groups' ) ) ) && ( !bp_nouveau_has_nav( array( 'object' => 'directory' ) ) ) ) :
bp_get_template_part( 'groups/single/parts/item-nav' );
endif;
?>

<?php if ( bp_nouveau_has_nav( array( 'object' => 'directory' ) ) ) : ?>
<div class="nhsuk-full-width-container">
    <div class="nhsuk-bordered-tabs-container">
        <div class="nhsuk-width-container">

            <nav class="" role="navigation" aria-label="<?php esc_attr_e( 'Directory menu', 'nightingale' ); ?>">

                    <ul class="nhsuk-bordered-tabs">

						<?php
						while ( bp_nouveau_nav_items() ) :
							bp_nouveau_nav_item();
							$link        = '';
							$current_url = $actual_link = ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							if ( bp_nouveau_get_nav_link() === $current_url ) {
								$link = ' nhsuk-bordered-tabs-item-active';
							}
							?>

                            <li id="<?php bp_nouveau_nav_id(); ?>" class="nhsuk-bordered-tabs-item <?php echo $link; ?>" <?php bp_nouveau_nav_scope(); ?> data-bp-object="<?php bp_nouveau_directory_nav_object(); ?>">
                                <a class="nhsuk-bordered-tabs-link" href="<?php bp_nouveau_nav_link(); ?>">
									<?php bp_nouveau_nav_link_text(); ?>

									<?php if ( bp_nouveau_nav_has_count() ) : ?>
                                        <span class="count"><?php bp_nouveau_nav_count(); ?></span>
									<?php endif; ?>
                                </a>
                            </li>

						<?php endwhile; ?>

                    </ul><!-- .component-navigation -->

            </nav><!-- .bp-navs -->
        </div>
    </div>
</div>
<?php endif; ?>
