<?php
/**
 * BuddyBoss - Groups Loop
 *
 * @since BuddyPress 3.0.0
 * @version 3.1.0
 */

bp_nouveau_before_loop();
?>
<?php if ( bp_get_current_group_directory_type() ) : ?>
    <div class="bp-feedback info">
    <span class="bp-icon" aria-hidden="true"></span>
	<p class="current-group-type"><?php bp_current_group_directory_type_message(); ?></p>
    </div>
<?php endif; ?>

<?php $cover_class = bp_disable_group_cover_image_uploads() ? 'bb-cover-disabled' : 'bb-cover-enabled'; ?>

<?php if ( bp_has_groups( bp_ajax_querystring( 'groups' ) ) ) : ?>

	<?php bp_nouveau_pagination( 'top' ); ?>

	<ul id="groups-list" class="nhsuk-grid-row nhsuk-card-group <?php echo $cover_class; ?>">

	<?php
	while ( bp_groups() ) :
		bp_the_group();
	?>

        <li class="nhsuk-grid-column-one-third nhsuk-card-group__item">

            <div class="nhsuk-card nhsuk-card--clickable">
                <div class="nhsuk-card__content">
	                <?php if( !bp_disable_group_cover_image_uploads() ) { ?>
		                <?php
		                $group_cover_image_url = bp_attachments_get_attachment( 'url', array(
			                'object_dir' => 'groups',
			                'item_id'    => bp_get_group_id(),
		                ) );
		                $default_group_cover   = get_theme_mod( 'buddyboss_group_cover_default', get_theme_file_uri( 'assets/images/svg/group-default.svg' ) );
		                $group_cover_image_url = $group_cover_image_url ?: $default_group_cover;
		                echo '<img src="' . $group_cover_image_url . '" class="nhsuk-card__img" />';
		                ?>
                        <?php } ?>

                    <h2 class="nhsuk-card__heading nhsuk-heading-m">
	                    <?php bp_group_link(); ?>
                    </h2>
                    <div class="nhsuk-card__description">
                        <?php bp_group_description_excerpt( false , 150 ) ?>
	                    <?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
                            <div class="item-avatar">
                                <a href="<?php bp_group_permalink(); ?>" class="group-avatar-wrap"><?php bp_group_avatar( bp_nouveau_avatar_args() ); ?></a>
                            </div>
	                            <?php if ( bp_nouveau_group_has_meta() ) : ?>

		                            <p class="nhsuk-body-s"><?php bp_nouveau_group_meta(); ?></p>
	                            <?php endif; ?>

	                            <p class="last-activity nhsuk-body-s">
		                            <?php
		                            printf(
		                            /* translators: %s = last activity timestamp (e.g. "active 1 hour ago") */
			                            __( 'active %s', 'nightingale'),
			                            bp_get_group_last_active()
		                            );
		                            ?>
	                            </p>
	                            <?php bp_nouveau_groups_loop_item(); ?>

	                            <div class="groups-loop-buttons footer-button-wrap"><?php bp_nouveau_groups_loop_buttons(); ?></div>

	                    <?php endif; ?>
                    </div>
                </div>
            </div>

        </li>

	<?php endwhile; ?>

	</ul>

	<?php bp_nouveau_pagination( 'bottom' ); ?>

<?php else : ?>

	<?php bp_nouveau_user_feedback( 'groups-loop-none' ); ?>

<?php endif; ?>

<?php
bp_nouveau_after_loop();
