<?php
/**
 * Customised Download Button
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
<p><a class="aligncenter nhsuk-button" href="<?php esc_html( $dlm_download->the_download_link() ); ?>" rel="nofollow">
		<?php
		// translators: link to the download.
		printf( esc_html_e( 'Download &ldquo;%s&rdquo;', 'nightingale' ), esc_html( $dlm_download->get_title() ) );
		?>
		<small>
			<?php
			echo esc_html( $dlm_download->get_version()->get_filename() );
			?>
			&ndash;
			<?php
			// translators: show number of times this has been downloaded.
			printf( esc_html( _n( 'Downloaded %d time', 'Downloaded %d times', $dlm_download->get_download_count(), 'nightingale' ) ), esc_html( $dlm_download->get_download_count() ) );
			?>
			&ndash;
			<?php
			echo esc_html( $dlm_download->get_version()->get_filesize_formatted() );
			?>
		</small>
	</a></p>
