<?php

/**
 * Forums Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>


<?php
$layout = buddyboss_theme_get_option( 'bbpress_forums_item_layout' );
$class = 'bs-card-list';

if( $layout == 'cover' ) {
	$class = 'bs-cover-list';
}
?>

<!-- Forums List -->
<?php do_action( 'bbp_template_before_forums_loop' ); ?>

	<ul class="grid-view bb-grid bb-forums-list <?php echo $class; ?>">
		<?php while ( bbp_forums() ) : bbp_the_forum(); ?>
			<?php bbp_get_template_part( 'loop-forum-card' ); ?>
		<?php endwhile; ?>
	</ul>

<?php do_action( 'bbp_template_after_forums_loop' ); ?>
