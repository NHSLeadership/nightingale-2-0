<?php
/**
 * Customised Gravity Forms summary markup
 *
 * @date         February 22nd 2021
 * @version      1.0
 * @author       Tony Blacker
 * @organisation NHS Leadership Academy
 * @copyright    OGL v3
 * @package      Nightingale Theme
 * Most email clients do not support style blocks.
 */

?>

<ul class="gf-all-fields nhsuk-summary-list">
	<?php
	foreach ( $items as $item ) :

		// Get field object for use in template.
		$field = isset( $item['field'] ) ? $item['field'] : new GF_Field();

		// Don't show pricing fields (just like GF default {all_fields}).
		if ( GFCommon::is_pricing_field( $field ) ) {
			continue;
		}

		// Add the field type as a CSS class for every field to make styling specific elements easier.
		$css_class = isset( $field ) ? 'field-type-' . $field->type : '';

		?>

		<li class="nhsuk-summary-list__row <?php echo esc_attr( $css_class ); ?>"">
			<span class="nhsuk-label"><?php echo esc_html( $item['label'] ); ?></span>
			<span class="nhsuk-summary-list__value"><?php echo $item['value']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		</li>

		<?php
	endforeach;
	?>
</ul>
