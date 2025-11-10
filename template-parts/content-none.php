<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

?>

<section id="error-no-results"  class="no-results not-found">
	<header class="entry-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'nightingale' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<div class="wp-block-nhsblocks-panel1 nhsuk-do-dont-list is-style-panel-with-label">
			<h3 class="nhsuk-do-dont-list__label"><?php echo esc_html__( 'Change your search terms', 'nightingale' ); ?></h3>
			<div class="paneltext">
				
			<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) :

				printf(
					'<p>' . wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'nightingale' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					) . '</p>',
					esc_url( admin_url( 'post-new.php' ) )
				);

				elseif ( is_search() ) :
					?>

					<p><?php esc_html_e( 'Sorry, we couldn\'t find anything. Try changing your search terms.', 'nightingale' ); ?></p>
					<?php
					get_search_form();

				else :
					?>

					<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'nightingale' ); ?></p>
					<?php
					get_search_form();

				endif;
				?>
					

			</div>
		</div>
	</div><!-- .page-content -->
	<div class="nhsuk-content__clearfix"></div>
</section><!-- .no-results -->
