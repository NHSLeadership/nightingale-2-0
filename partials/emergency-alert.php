<?php
/**
 * The emergency alert region for our theme
 *
 * This is the template that displays the emergency-alert region
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @link https://nhsuk.github.io/nhsuk-frontend/components/emergency-alert/index.html
 *
 * @package Nightingale_2.0
 */

?>
<div class="nhsuk-global-alert" id="nhsuk-global-alert">
    <div class="nhsuk-width-container">
        <div class="nhsuk-grid-row">
            <div class="nhsuk-grid-column-full">
                <div class="nhsuk-global-alert__content">
                    <h2 class="nhsuk-global-alert__heading"><span class="nhsuk-u-visually-hidden">Alert: </span><?php echo get_theme_mod('emergency_heading'); ?></h2>
                    <p class="nhsuk-global-alert__message"><?php echo get_theme_mod('emergency_content'); ?> <a href="<?php echo get_theme_mod('emergency_link'); ?>"><?php echo get_theme_mod('emergency_link_title'); ?></a></p>
                    <?php if (get_theme_mod('emergency_date') != 'dd/mm/yyyy') {
                        $date = strtotime(get_theme_mod('emergency_date'));
                        echo '<p class="nhsuk-global-alert__updated">Last Updated '.date('jS F Y', $date).'</p>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
