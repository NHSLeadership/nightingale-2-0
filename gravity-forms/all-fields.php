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
 * Most email clients do not support style blocks. We'll define our styles here and output them inline in the markup below.
 */

$styles = array(
	'span.label' => 'vertical-align: top; font-weight: bold;',
);

// Make a back-up of the styles we've just defined. This allows us to make temporary changes to the styles below and then
// reset the styles for the next item.
$reset_styles = $styles;
?>

<ul class="gf-all-fields"">
	<?php
	foreach ( $items as $item ) :

		// Get field object for use in template.
		$field = isset( $item['field'] ) ? $item['field'] : new GF_Field();

		// Don't show pricing fields (just like GF default {all_fields}).
		if ( GFCommon::is_pricing_field( $field ) ) {
			continue;
		}

		// Change the style a bit for Section fields.
		if ( $field->get_input_type() === 'section' ) {
			$styles['li'] .= 'padding-bottom: 10px;';
		}

		// Add the field type as a CSS class for every field to make styling specific elements easier.
		$css_class = isset( $field ) ? 'field-type-' . $field->type : '';

		?>

		<li class="<?php echo esc_attr( $css_class ); ?>"">
			<span class="label" style="<?php echo esc_attr( $styles['span.label'] ); ?>"><?php echo esc_html( $item['label'] ); ?></span>
			<span><?php echo $item['value']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		</li>

		<?php
		// Reset any temporary changes we made to our core styles.
		$styles = $reset_styles;
	endforeach;
	?>
</ul>
