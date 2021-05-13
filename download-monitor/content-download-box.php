<?php
/**
 * Customised Download Box
 *
 * @date         March 1st 2021
 * @version      1.0
 * @author       Tony Blacker
 * @organisation NHS Leadership Academy
 * @copyright    OGL v3
 * @package      Nightingale Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

?>
<aside class="nhsuk-card">

	<div class="nhsuk-card__content">

		<h3 class="nhsuk-card__heading"><?php $dlm_download->the_title(); ?></h3>

		<span class="nhsuk-card__description"><?php $dlm_download->the_excerpt(); ?></span>

		<a class="nhsuk-button" title="
		<?php
		if ( $dlm_download->get_version()->has_version_number() ) {
			// translators: State Version variant.
			printf( esc_html_e( 'Version %s', 'nightingale' ), esc_html( $dlm_download->get_version()->get_version_number() ) );
		}
		?>
		" href="
		<?php
		$dlm_download->the_download_link();
		?>
		" rel="nofollow">
			<?php
			esc_html_e( 'Download File', 'nightingale' );
			?>
			<small><?php echo esc_html( $dlm_download->get_version()->get_filename() ); ?> &ndash; <?php echo esc_html( $dlm_download->get_version()->get_filesize_formatted() ); ?></small>
		</a>
		<div
				class="nhsuk-tag download-count">
			<?php
			// translators: Name the download.
			printf( esc_html( _n( '%d download', '%d downloads', $dlm_download->get_download_count(), 'nightingale' ) ), esc_html( $dlm_download->get_download_count() ) );
			?>
		</div>

	</div>
</aside>


