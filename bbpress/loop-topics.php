<?php

/**
 * Topics Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<?php do_action( 'bbp_template_before_topics_loop' ); ?>

<div id="bbp-forum-<?php bbp_forum_id(); ?>" class="nhsuk-list-panel__list comment-list bbp-topics1 bs-item-list bs-forums-items list-view">

                    <h2>
	                    <?php
	                    if ( bbp_is_topic_tag() ) {
		                    $bbp_topic_tag = get_query_var( 'bbp_topic_tag' );

		                    if ( bbp_is_shortcode() && bbp_is_query_name( 'bbp_topic_tag' ) && ! empty( bbpress()->current_topic_tag_id ) ) {
			                    $bbp_tag_term = get_term( bbpress()->current_topic_tag_id );
			                    if ( ! empty( $bbp_tag_term->name ) ) {
				                    $bbp_topic_tag = $bbp_tag_term->name;
			                    }
		                    }

		                    echo sprintf( __( "Discussions tagged with '%s' ", 'nightingale' ), $bbp_topic_tag );
	                    } else {
		                    if ( bbp_is_shortcode() && bbp_is_query_name( 'bbp_view' ) && 'popular' === bbpress()->current_view_id ) {
			                    _e( 'Popular Discussions', 'nightingale' );
		                    } else if ( bbp_is_shortcode() && bbp_is_query_name( 'bbp_view' ) && 'no-replies' === bbpress()->current_view_id ) {
			                    _e( 'Unanswered Discussions', 'nightingale' );
		                    } else {
			                    _e( 'All Discussions', 'nightingale' );
		                    }
	                    }
	                    ?>
                    </h2>


	<?php while ( bbp_topics() ) : bbp_the_topic(); ?>
		<?php bbp_get_template_part( 'loop', 'topic-list' ); ?>

	<?php endwhile; ?>

</div><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->

<?php do_action( 'bbp_template_after_topics_loop' ); ?>
