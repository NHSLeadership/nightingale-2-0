<?php
/**
 * BuddyPress - Groups Cover Image Header.
 *
 * @since 3.0.0
 * @version 3.1.0
 */

$group_link = bp_get_group_permalink();
$admin_link = trailingslashit( $group_link . 'admin' );
$group_avatar = trailingslashit( $admin_link . 'group-avatar' );
$group_cover_link = trailingslashit( $admin_link . 'group-cover-image' );

// Group cover size
$group_cover_width = nightingale_buddyboss_theme_get_option( 'buddyboss_group_cover_width' );
$group_cover_height = nightingale_buddyboss_theme_get_option( 'buddyboss_group_cover_height' );
$group_cover_image_url = bp_attachments_get_attachment( 'url', array(
	'object_dir' => 'groups',
	'item_id'    => bp_get_group_id(),
) );
$default_group_cover   = get_theme_mod( 'buddyboss_group_cover_default', get_theme_file_uri( 'assets/images/svg/newsletter-bg.svg' ) );
$group_cover_image_url = $group_cover_image_url ?: $default_group_cover;
?>

<div class="wp-block-nhsblocks-heroblock nhsuk-hero nhsuk-hero--image nhsuk-hero--image-description" style="background-image: url(<?php echo $group_cover_image_url; ?>); background-size: cover; background-position: center center;">
	<div class="nhsuk-hero__overlay">
		<div class="nhsuk-width-container">
			<div class="nhsuk-grid-row">
				<?php if ( bp_is_item_admin() && bp_group_use_cover_image_header() ) { ?>
					<a href="<?php echo $group_cover_link; ?>" class="link-change-cover-image" data-balloon-pos="right" data-balloon="<?php _e('Change Cover Image', 'nightingale'); ?>">
						<span class="dashicons dashicons-edit"></span>
					</a>
				<?php } ?>
				<div class="nhsuk-grid-column-two-thirds">
					<div class="wp-block-nhsblocks-heroinner nhsuk-hero-content">
						<h1 class="nhsuk-u-margin-bottom-3">
							<?php echo esc_attr( bp_get_group_name() ); ?>
						</h1>
						<p class="nhsuk-body-l nhsuk-u-margin-bottom-0"><?php echo wp_kses( bp_nouveau_group_meta()->status, array( 'span' => array( 'class' => array() ) ) ); ?></p>

						<span class="nhsuk-hero__arrow" aria-hidden="true"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php //bp_get_template_part( 'groups/single/parts/header-item-actions' ); ?>

