<?php

/**
 * Single Reply Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="bbpress-forums">

	<?php bbp_breadcrumb(); ?>

	<?php do_action( 'bbp_template_before_single_reply' ); ?>

	<?php if ( post_password_required() ) : ?>

		<?php bbp_get_template_part( 'form', 'protected' ); ?>

	<?php else : ?>
		<ul class="bs-item-list bs-forums-items bs-single-forum-list bb-single-reply-list list-view bb-single">
			<li class="bs-item-wrap bs-header-item align-items-center no-hover-effect">
				<?php bbp_get_template_part( 'loop', 'single-reply' ); ?>
			</li>
		</ul>
	<?php endif; ?>

	<?php do_action( 'bbp_template_after_single_reply' ); ?>

</div>