<?php
/**
 * Customised Download Version List
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


$versions = $dlm_download->get_versions();

if ( $versions ) : ?>
	<ul class="nhsuk-list nhsuk-list--bullet">
		<?php
		foreach ( $versions as $version ) {

			// set loop version as current version.
			$dlm_download->set_version( $version );
			?>
			<li>
				<a class="download-link" title="
				<?php
				// translators: show number of times this has been downloaded.
				printf( esc_html( _n( 'Downloaded %d time', 'Downloaded %d times', $dlm_download->get_download_count(), 'nightingale' ) ), esc_html( $dlm_download->get_download_count() ) );
				?>
				" href="
				<?php
				esc_html( $dlm_download->the_download_link() );
				?>
				" rel="nofollow">
					<?php
					echo esc_html( $version->get_filename() );
					?>

					<?php
					if ( $version->has_version_number() ) {
						echo '- ' . esc_html( $version->get_version_number() );
					}
					?>
				</a>
			</li>
			<?php
		}
		?>
	</ul>
<?php endif; ?>
