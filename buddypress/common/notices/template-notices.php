<?php
/**
 * BP Nouveau template notices template.
 *
 * @since BuddyPress 3.0.0
 * @version 3.1.0
 */

$bp = buddypress();
?>

<aside class="<?php bp_nouveau_template_message_classes(); ?>">
	<?php
	if ( ! empty( $bp->template_message ) && ! empty( $bp->template_message_type ) && $bp->template_message_type == 'bp-sitewide-notice' ) {
		echo '<div class="bp-sitewide-notice-wrap">';
	}
	?>

	<span class="bp-icon" aria-hidden="true"></span>
	<?php bp_nouveau_template_message(); ?>

	<?php if ( bp_nouveau_has_dismiss_button() ) : ?>
		<button type="button" data-balloon-pos="down" class="" data-balloon="<?php echo esc_attr_x( 'Close', 'button', 'nightingale'); ?>" aria-label="<?php esc_attr_e( 'Close this notice', 'nightingale'); ?>" data-bp-close="<?php bp_nouveau_dismiss_button_type(); ?>"><span class="bb-icon-close-circle" aria-hidden="true"></span></button>
	<?php endif; ?>

	<?php
	if ( ! empty( $bp->template_message ) && ! empty( $bp->template_message_type ) && $bp->template_message_type == 'bp-sitewide-notice' ) {
		echo '</div>';
	}
	?>
</aside>
