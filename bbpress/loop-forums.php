<?php

/**
 * Forums Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>


<?php
$class = 'bs-card-list';

?>

<!-- Forums List -->
<?php do_action( 'bbp_template_before_forums_loop' ); ?>

	<div class="nhsuk-list-panel__list comment-list bb-forums-list <?php echo $class; ?>">
		<?php while ( bbp_forums() ) : bbp_the_forum(); ?>
			<?php bbp_get_template_part( 'loop-forum-card' ); ?>
		<?php endwhile; ?>
	</div>

<?php do_action( 'bbp_template_after_forums_loop' ); ?>
