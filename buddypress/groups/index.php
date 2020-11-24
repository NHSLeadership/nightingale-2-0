<?php
/**
 * BP Nouveau - Groups Directory
 *
 * @since BuddyPress 3.0.0
 * @version 3.0.0
 */
?>

    <div class="subnav-search groups-search nhsuk-buddy__search">
        <?php bp_nouveau_search_form(); ?>
    </div>

	<?php bp_nouveau_before_groups_directory_content(); ?>

	<?php bp_nouveau_template_notices(); ?>

	<div class="flex bp-secondary-header align-items-center">
		<div class="push-right flex">
            <div class="bp-group-filter-wrap subnav-filters filters no-ajax">
				<?php bp_get_template_part( 'common/filters/group-filters' ); ?>
            </div>
			<div class="bp-groups-filter-wrap subnav-filters filters no-ajax">
				<?php bp_get_template_part( 'common/filters/directory-filters' ); ?>
			</div>
		</div>
	</div>

	<div class="screen-content">

		<div id="groups-dir-list" class="groups dir-list" data-bp-list="groups">
			<div id="bp-ajax-loader"><?php bp_nouveau_user_feedback( 'directory-groups-loading' ); ?></div>
		</div><!-- #groups-dir-list -->

	<?php bp_nouveau_after_groups_directory_content(); ?>
	</div><!-- // .screen-content -->

