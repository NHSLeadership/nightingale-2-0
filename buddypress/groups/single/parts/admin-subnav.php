<?php
/**
 * BuddyPress Single Groups Admin Navigation
 *
 * @since BuddyPress 3.0.0
 * @version 3.0.0
 */
?>
<div class="nhsuk-grid-full-width">
    <nav class="nhsuk-bordered-tabs-container" id="subnav" role="navigation" aria-label="<?php esc_attr_e( 'Group administration menu', 'nightingale' ); ?>">

	<?php if ( bp_nouveau_has_nav( array( 'object' => 'group_manage' ) ) ) : ?>

		<ul class="nhsuk-bordered-tabs">

			<?php
			while ( bp_nouveau_nav_items() ) :
				bp_nouveau_nav_item();$current = bp_nouveau_get_nav_link();
				$link        = '';
				$current_url = $actual_link = ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $admin_links = array(
                        '/edit-details/',
                        '/group-settings/',
                        '/group-avatar/',
                        '/group-cover-image/',
                        '/manage-members/',
                        '/membership-requests/',
                        '/forum/',
                        '/courses/',
                        '/delete-group/',
                );
                foreach ($admin_links as $links) {
	                if ( strpos( $current_url, $links ) !== false ) {
		                if ( strpos( bp_nouveau_get_nav_link(), $links ) !== false ) {
			                $link = ' nhsuk-bordered-tabs-item-active-alt';
		                }
	                }
                }
			?>

				<li id="<?php bp_nouveau_nav_id(); ?>" class="nhsuk-bordered-tabs-item <?php echo $link; ?>">
					<a href="<?php bp_nouveau_nav_link(); ?>" id="<?php bp_nouveau_nav_link_id(); ?>" class="nhsuk-bordered-tabs-link">
						<?php bp_nouveau_nav_link_text(); ?>

						<?php if ( bp_nouveau_nav_has_count() ) : ?>
							<span class="count"><?php bp_nouveau_nav_count(); ?></span>
						<?php endif; ?>
					</a>
				</li>

			<?php endwhile; ?>

		</ul>

	<?php endif; ?>

</nav><!-- #isubnav -->
</div>
<br />
