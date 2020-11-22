<?php

/**
 * Topics Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
tony was here
<?php do_action( 'bbp_template_before_topics_loop' ); ?>

<ul id="bbp-forum-<?php bbp_forum_id(); ?>" class="bbp-topics1 bs-item-list bs-forums-items list-view">

	<li class="bs-item-wrap bs-header-item align-items-center no-hover-effect">
		<div class="flex-1">
            <h2 class="bs-section-title"><?php
                if ( bbp_is_topic_tag() ) {
	                $bbp_topic_tag = get_query_var( 'bbp_topic_tag' );

                    if ( bbp_is_shortcode() && bbp_is_query_name( 'bbp_topic_tag' ) && ! empty( bbpress()->current_topic_tag_id ) ) {
                        $bbp_tag_term = get_term( bbpress()->current_topic_tag_id );
                        if ( ! empty( $bbp_tag_term->name ) ) {
	                        $bbp_topic_tag = $bbp_tag_term->name;
                        }
                    }

	                echo sprintf( __( "Discussions tagged with '%s' ", 'buddyboss-theme' ), $bbp_topic_tag );
                } else {
	                if ( bbp_is_shortcode() && bbp_is_query_name( 'bbp_view' ) && 'popular' === bbpress()->current_view_id ) {
		                _e( 'Popular Discussions', 'buddyboss-theme' );
                    } else if ( bbp_is_shortcode() && bbp_is_query_name( 'bbp_view' ) && 'no-replies' === bbpress()->current_view_id ) {
		                _e( 'Unanswered Discussions', 'buddyboss-theme' );
                    } else {
		                _e( 'All Discussions', 'buddyboss-theme' );
	                }
                }
                 ?>
            </h2>
        </div>
	</li>

	<?php while ( bbp_topics() ) : bbp_the_topic(); ?>

		<?php //bbp_get_template_part( 'loop', 'single-topic' ); ?>
		<?php bbp_get_template_part( 'loop', 'topic-list' ); ?>

	<?php endwhile; ?>

</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->

<?php do_action( 'bbp_template_after_topics_loop' ); ?>
