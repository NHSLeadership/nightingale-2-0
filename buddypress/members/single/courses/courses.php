<?php
/**
 * @package WordPress
 * @subpackage BuddyPress for LearnDash
 */

$filepath = locate_template(
	array(
		'learndash/learndash_template_script.min.js',
		'learndash/learndash_template_script.js',
		'learndash_template_script.min.js',
		'learndash_template_script.js',
	)
);

$view              = get_option( 'bb_theme_learndash_grid_list', 'grid' );
$class_grid_active = ( 'grid' === $view ) ? 'active' : '';
$class_list_active = ( 'list' === $view ) ? 'active' : '';
$class_grid_show   = ( 'grid' === $view ) ? 'grid-view bb-grid' : '';
$class_list_show   = ( 'list' === $view ) ? 'list-view bb-list' : '';

if ( ! empty( $filepath ) ) {
	wp_enqueue_script( 'learndash_template_script_js', str_replace( ABSPATH, '/', $filepath ), array( 'jquery' ), LEARNDASH_VERSION, true );
	$learndash_assets_loaded['scripts']['learndash_template_script_js'] = __FUNCTION__;
} elseif ( file_exists( LEARNDASH_LMS_PLUGIN_DIR . '/templates/learndash_template_script' . ( ( defined( 'LEARNDASH_SCRIPT_DEBUG' ) && ( LEARNDASH_SCRIPT_DEBUG === true ) ) ? '' : '.min' ) . '.js' ) ) {
	wp_enqueue_script( 'learndash_template_script_js', LEARNDASH_LMS_PLUGIN_URL . 'templates/learndash_template_script' . ( ( defined( 'LEARNDASH_SCRIPT_DEBUG' ) && ( LEARNDASH_SCRIPT_DEBUG === true ) ) ? '' : '.min' ) . '.js', array( 'jquery' ), LEARNDASH_VERSION, true );
	$learndash_assets_loaded['scripts']['learndash_template_script_js'] = __FUNCTION__;
	$data            = array();
	$data['ajaxurl'] = admin_url( 'admin-ajax.php' );
	$data            = array( 'json' => wp_json_encode( $data ) );
	wp_localize_script( 'learndash_template_script_js', 'sfwd_data', $data );
}

// LD_QuizPro::showModalWindow();
add_action( 'wp_footer', array( 'LD_QuizPro', 'showModalWindow' ), 20 );
?>

<?php
$user_id  = bp_displayed_user_id();
$defaults = array(
	'user_id'            => get_current_user_id(),
	'per_page'           => false,
	'order'              => 'DESC',
	'orderby'            => 'ID',
	'course_points_user' => 'yes',
	'expand_all'         => false,
);
$atts     = apply_filters( 'bp_learndash_user_courses_atts', $defaults );
$atts     = wp_parse_args( $atts, $defaults );
if ( $atts['per_page'] === false ) {
	$atts['per_page'] = $atts['quiz_num'] = LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Section_General_Per_Page', 'per_page' );
} else {
	$atts['per_page'] = intval( $atts['per_page'] );
}

if ( $atts['per_page'] > 0 ) {
	$atts['paged'] = 1;
} else {
	unset( $atts['paged'] );
	$atts['nopaging'] = true;
}

$user_courses       = apply_filters( 'bp_learndash_user_courses', ld_get_mycourses( $user_id, $atts ) );
$usermeta           = get_user_meta( $user_id, '_sfwd-quizzes', true );
$quiz_attempts_meta = empty( $usermeta ) ? false : $usermeta;
$quiz_attempts      = array();
$profile_pager      = array();

if ( ( isset( $atts['per_page'] ) ) && ( intval( $atts['per_page'] ) > 0 ) ) {
	$atts['per_page'] = intval( $atts['per_page'] );
	if ( ( isset( $_GET['ld-profile-page'] ) ) && ( ! empty( $_GET['ld-profile-page'] ) ) ) {
		$profile_pager['paged'] = intval( $_GET['ld-profile-page'] );
	} else {
		$profile_pager['paged'] = 1;
	}

	$profile_pager['total_items'] = count( $user_courses );
	$profile_pager['total_pages'] = ceil( count( $user_courses ) / $atts['per_page'] );
	$user_courses                 = array_slice( $user_courses, ( $profile_pager['paged'] * $atts['per_page'] ) - $atts['per_page'], $atts['per_page'], false );
}

if ( ! empty( $quiz_attempts_meta ) ) {
	foreach ( $quiz_attempts_meta as $quiz_attempt ) {
		$c                          = learndash_certificate_details( $quiz_attempt['quiz'], $user_id );
		$quiz_attempt['post']       = get_post( $quiz_attempt['quiz'] );
		$quiz_attempt['percentage'] = ! empty( $quiz_attempt['percentage'] ) ? $quiz_attempt['percentage'] : ( ! empty( $quiz_attempt['count'] ) ? $quiz_attempt['score'] * 100 / $quiz_attempt['count'] : 0 );

		if ( $user_id === get_current_user_id() && ! empty( $c['certificateLink'] ) && ( ( isset( $quiz_attempt['percentage'] ) && $quiz_attempt['percentage'] >= $c['certificate_threshold'] * 100 ) ) ) {
			$quiz_attempt['certificate'] = $c;
		}
		$quiz_attempts[ learndash_get_course_id( $quiz_attempt['quiz'] ) ][] = $quiz_attempt;
	}
}
?>

<div id="bb-learndash_profile" class="<?php echo empty( $user_courses ) ? 'user-has-no-lessons' : ''; ?>">
    <div id="learndash-content" class="learndash-course-list">
		<?php
		if ( ! empty( $user_courses ) ) {
			?>
            <form id="bb-courses-directory-form" class="bb-courses-directory" method="get" action="">
                <div class="flex align-items-center bb-courses-header">
                    <div id="courses-dir-search" class="bs-dir-search" role="search"></div>
                    <div class="bb-secondary-list-tabs flex align-items-center" id="subnav" aria-label="Members directory secondary navigation" role="navigation">
                        <div class="grid-filters" data-view="ld-course">
                            <a href="#" class="layout-view layout-view-course layout-grid-view bp-tooltip <?php echo esc_attr( $class_grid_active ); ?>" data-view="grid" data-bp-tooltip-pos="up" data-bp-tooltip="<?php _e( 'Grid View', 'nightingale'); ?>">
                                <i class="dashicons dashicons-screenoptions" aria-hidden="true"></i>
                            </a>

                            <a href="#" class="layout-view layout-view-course layout-list-view bp-tooltip <?php echo esc_attr( $class_list_active ); ?>" data-view="list" data-bp-tooltip-pos="up" data-bp-tooltip="<?php _e( 'List View', 'nightingale'); ?>">
                                <i class="dashicons dashicons-menu" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="grid-view bb-grid">
                    <div id="course-dir-list" class="course-dir-list bs-dir-list">
						<?php
						if ( ! empty( $user_courses ) ) :
							global $post;
							$_post = $post;
							?>
                            <ul class="bb-course-list bb-course-items <?php echo esc_attr( $class_grid_show . $class_list_show ); ?>" aria-live="assertive" aria-relevant="all">
								<?php
								foreach ( $user_courses as $course_id ) :
									$course = get_post( $course_id );
									$post   = $course;
									get_template_part( 'learndash/ld30/template-course-item' );
								endforeach;
								?>
                            </ul>
							<?php
							$post = $_post;
						endif;
						?>

						<?php
						if ( $profile_pager['total_items'] >= 21 ) {
							// @todo We need a cleaner solution than this
							?>

                            <div class="bb-lms-pagination">
								<?php
								$page                = (int) $profile_pager['paged'];
								$num_results_on_page = (int) $atts['per_page'];
								$totalPages          = (int) $profile_pager['total_pages'];

								if ( $page <= 1 ) {
								} else {
									$j = $page - 1;
									echo "<a class='prev page-numbers' id='page_a_link' href='?ld-profile-page=$j'>" . __( '« Previous', 'nightingale') . '</a>';
								}

								for ( $i = 1; $i <= $totalPages; $i ++ ) {
									if ( $i <> $page ) {
										echo "<span><a id='page_a_link' href='?ld-profile-page=$i'>$i</a></span>";
									} else {
										echo "<span id='page_links' style='font-weight: bold;'>$i</span>";
									}
								}

								if ( $page == $totalPages ) {
								} else {
									$j = $page + 1;
									echo "<a class='next page-numbers'  id='page_a_link' href='?ld-profile-page=$j'>" . __( 'Next »', 'nightingale') . '</a>';
								}

								?>
                            </div>

							<?php
						}
						?>
                    </div>
                </div>
            </form>
			<?php
		} else {
			?>
            <aside class="bp-feedback bp-messages info">
                <span class="bp-icon" aria-hidden="true"></span>
                <p>
					<?php
					printf(
						__( 'Sorry, no %s were found.', 'nightingale'),
						LearnDash_Custom_Label::label_to_lower( 'courses' )
					);
					?>
                </p>
            </aside>
			<?php
		}
		?>
    </div>
</div>
