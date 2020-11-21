<?php
/**
 * Group Members Loop template
 *
 * @since 3.0.0
 * @version 3.0.0
 */
?>

<?php
$message_button_args = array(
	'link_text'         => '<i class="bb-icon-mail-small"></i>',
	'button_attr' => array(
		'data-balloon-pos' => 'down',
		'data-balloon' => __( 'Message', 'nightingale'),
	)
);

$footer_buttons_class = ( bp_is_active('friends') && bp_is_active('messages') ) ? 'footer-buttons-on' : '';

$is_follow_active = bp_is_active('activity') && bp_is_activity_follow_active();
$follow_class = $is_follow_active ? 'follow-active' : '';
?>
<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) :  ?>

	<?php bp_nouveau_group_hook( 'before', 'members_content' ); ?>

	<?php bp_nouveau_pagination( 'top' ); ?>


    <table id="members-list" role="table" class="nhsuk-table">
        <caption class="nhsuk-table__caption">Members of <?php echo esc_attr( bp_get_group_name() ); ?></caption>
        <thead role="rowgroup" class="nhsuk-table__head">
        <tr role="row">
            <th role="columnheader" class="" scope="col">
                Name
            </th>
            <th role="columnheader" class="" scope="col">
                Actions
            </th>
        </tr>
        </thead>
        <tbody class="nhsuk-table__body">

		<?php
		while while ( bp_members() ) : bp_the_member();
			?>
			<?php
			$member_id           = bp_get_member_user_id();
			//$show_message_button = buddyboss_theme()->buddypress_helper()->buddyboss_theme_show_private_message_button( $member_id, bp_loggedin_user_id() );
			//Check if members_list_item has content
			ob_start();
			bp_nouveau_member_hook( '', 'members_list_item' );
			$members_list_item_content = ob_get_contents();
			ob_end_clean();
			$member_loop_has_content = empty($members_list_item_content) ? false : true;
			?>
            <tr role="row" class="nhsuk-table__row">
                <td role="cell" class="nhsuk-table__cell">
                    <div style="float:left; margin-right: 16px;" class="item-avatar">
                        <a href="<?php bp_group_member_domain(); ?>">
							<?php bp_group_member_avatar(); ?>
							<?php //bb_user_status( bp_get_group_member_id() ); ?>
                        </a>
                    </div>
					<?php bp_group_member_link(); ?><br />
                    <span class="nhsuk-body-s">
						<?php
						$user_id               = bp_get_group_member_id();
						$group_id              = bp_get_current_group_id();
						if ( groups_is_user_admin( $user_id, $group_id ) ) {
							esc_html_e( get_group_role_label( $group_id, 'organizer_singular_label_name' ), 'nightingale' );
						} elseif ( groups_is_user_mod( $user_id, $group_id ) ) {
							esc_html_e( get_group_role_label( $group_id, 'moderator_singular_label_name' ), 'nightingale' );
						} elseif ( groups_is_user_member( $user_id, $group_id ) ) {
							esc_html_e( get_group_role_label( $group_id, 'member_singular_label_name' ), 'nightingale' );
						}
						?>
					</span>
                    <span class="nhsuk-body-s"><?php bp_group_member_joined_since(); ?></span>

                </td>
                <td role="cell" class="nhsuk-table__cell">
					<?php
					if( bp_is_active('friends') ) {
						bp_add_friend_button();
					}

					//if( bp_is_active('messages') ) {
					//if ( 'yes' === $show_message_button ) {
					bp_send_message_button( $message_button_args );
					//}
					//}
					//if( $is_follow_active ) {
					bp_add_follow_button( bp_get_group_member_id(), bp_loggedin_user_id() );
					//}
					?>
					<?php
					if($member_loop_has_content){ ?>
                        <a class="more-action-button" href="#"><i class="bb-icon-menu-dots-h"></i></a>
					<?php } ?>
                    <div class="bp-members-list-hook-inner">
						<?php bp_nouveau_member_hook( '', 'members_list_item' ); ?>
                    </div>
                </td>
            </tr>
		<?php endwhile; ?>

        </tbody>
    </table>

	<?php bp_nouveau_group_hook( 'after', 'members_list' ); ?>

	<?php bp_nouveau_pagination( 'bottom' ); ?>

	<?php bp_nouveau_group_hook( 'after', 'members_content' ); ?>

<?php else :

	bp_nouveau_user_feedback( 'group-members-none' );

endif;
